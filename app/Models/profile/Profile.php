<?php

namespace App\Models\profile;

use App\Models\Address;
use App\Models\Week;
use App\Models\ContractType;
use App\Models\Dress;
use App\Models\Follow;
use App\Models\History;
use App\Models\Invite;
use App\Models\JobType;
use App\Models\profile\ProfileEducation;
use App\Models\profile\ProfileEmployee;
use App\Models\profile\ProfileExperience;
use App\Models\profile\ProfileJob;
use App\Models\profile\ProfilePortfolio;
use App\Models\profile\ProfileQualification;
use App\Models\profile\ProfileWriting;
use App\Models\Project;
use App\Models\RemoteWork;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function weeks() {
        return $this->belongsTo(Week::class, 'week', 'id');
    }

    public function dress() {
        return $this->belongsTo(Dress::class, 'dress_id', 'id');
    }

    public function location() {
        return $this->belongsTo(Address::class, 'work_location_id', 'id');
    }

    public function remote_work() {
        return $this->belongsTo(RemoteWork::class, 'remote_work_id', 'id');
    }

    public function skills() {
        return $this->hasMany(ProfileSkill::class, 'user_id', 'user_id');
    }

    public function educations() {
        return $this->hasMany(ProfileEducation::class, 'user_id', 'user_id');
    }

    public function employees() {
        return $this->hasMany(ProfileEmployee::class, 'user_id', 'user_id');
    }

    public function experiences() {
        return $this->hasMany(ProfileExperience::class, 'user_id', 'user_id');
    }

    public function jobs() {
        return $this->belongsToMany(JobType::class, 'profile_job', 'user_id', 'job_id', 'user_id', 'id');
    }

    public function contractTypes() {
        return $this->belongsToMany(ContractType::class, 'profile_contract', 'user_id', 'contract_id', 'user_id', 'id');
    }

    public function portfolios() {
        return $this->hasMany(ProfilePortfolio::class, 'user_id', 'user_id');
    }

    public function qualifications() {
        return $this->hasMany(ProfileQualification::class, 'user_id', 'user_id');
    }

    public function writings() {
        return $this->hasMany(ProfileWriting::class, 'user_id', 'user_id');
    }

    public function getReview($user_id) {
        $user = User::find($user_id);
        $projects = Project::where('user_id', $user_id);

        $review['score']['projects'] = $projects->count();
        $review['score']['projects_view'] = $projects->sum('views');
        $review['score']['projects_end'] = $projects->where('status', 0)->count();
        $review['score']['follow_cnt'] = $user->follow->count();
        $review['score']['followed_cnt'] = $user->follow_by->count();
        $review['score']['invites'] = Invite::where([['user_id', $user_id], ['accepted', 1]])->count();

        $review['level']['projects'] = Review::where([['type', config('constants.review.projects')], ['require', '<=', $review['score']['projects']]])->latest('id')->first()->level ?? 0;
        $review['level']['projects_view'] = Review::where([['type', config('constants.review.projects_view')], ['require', '<=', $review['score']['projects_view']]])->latest('id')->first()->level ?? 0;
        $review['level']['projects_end'] = Review::where([['type', config('constants.review.projects_end')], ['require', '<=', $review['score']['projects_end']]])->latest('id')->first()->level ?? 0;
        $review['level']['follow_cnt'] = Review::where([['type', config('constants.review.follow_cnt')], ['require', '<=', $review['score']['follow_cnt']]])->latest('id')->first()->level ?? 0;
        $review['level']['followed_cnt'] = Review::where([['type', config('constants.review.followed_cnt')], ['require', '<=', $review['score']['followed_cnt']]])->latest('id')->first()->level ?? 0;
        $review['level']['invites'] = Review::where([['type', config('constants.review.invites')], ['require', '<=', $review['score']['invites']]])->latest('id')->first()->level ?? 0;

        $histories = History::all();
        $projects = Project::withoutGlobalScope('deleted')->where('user_id', $user_id)->pluck('id')->toArray();
        $review['history']['projects'] = Project::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where('user_id', $user_id)->groupBy('date')->get()->toArray();
        $review['history']['projects_view'] = History::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where('type_id', 13)->whereIn('data_id', $projects)->groupBy('date')->get()->toArray();
        $review['history']['projects_end'] = History::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where([['user_id', $user_id], ['type_id', 7]])->groupBy('date')->get()->toArray();
        $review['history']['follow_cnt'] = History::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where([['user_id', $user->id], ['type_id', 11]])->groupBy('date')->get()->toArray();
        $review['history']['followed_cnt'] = History::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where([['data_id', $user->id], ['type_id', 11]])->groupBy('date')->get()->toArray();
        $review['history']['invites'] = Invite::selectRaw('DATE(created_at) AS date, COUNT(*) AS count')->where([['user_id', $user->id], ['accepted', 1]])->groupBy('date')->get()->toArray();

        // $review['history']['projects'] = [1, 3, 2, 4, 3, 5, 4, 6, 5, 7];
        // $review['history']['projects_view'] = [4, 7, 5, 2, 5, 7, 8, 6, 4, 6];
        // $review['history']['projects_end'] = [8, 3, 5, 2, 7, 4, 5, 6, 6, 3];
        // $review['history']['follow_cnt'] = [4, 6, 2, 7, 8, 4, 5, 8, 3, 2];
        // $review['history']['followed_cnt'] = [5, 7, 2, 4, 8, 6, 7, 8, 2, 4];
        // $review['history']['invites'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $latest = User::where('user_type', '<>', config('constants.user_type.admin'))->count();
        $review['rank']['projects'] = Project::selectRaw('user_id, RANK() OVER (ORDER BY COUNT(id) DESC) rank')->groupBy('user_id')->get()->filter(function ($item) use($user_id) { return $item->user_id == $user_id; })->first();
        $review['rank']['projects_view'] = Project::selectRaw('user_id, RANK() OVER (ORDER BY SUM(views) DESC) rank')->groupBy('user_id')->get()->filter(function ($item) use($user_id) { return $item->user_id == $user_id; })->first();
        $review['rank']['projects_end'] = Project::selectRaw('user_id, RANK() OVER (ORDER BY SUM(status) DESC) rank')->groupBy('user_id')->get()->filter(function ($item) use($user_id) { return $item->user_id == $user_id; })->first();
        $review['rank']['follow_cnt'] = Follow::selectRaw('follow_by, RANK() OVER (ORDER BY COUNT(id) DESC) rank')->groupBy('follow_by')->get()->filter(function ($item) use($user_id) { return $item->follow_by == $user_id; })->first();
        $review['rank']['followed_cnt'] = Follow::selectRaw('follow, RANK() OVER (ORDER BY COUNT(id) DESC) rank')->groupBy('follow')->get()->filter(function ($item) use($user_id) { return $item->follow == $user_id; })->first();
        $review['rank']['invites'] = Invite::selectRaw('user_id, RANK() OVER (ORDER BY SUM(accepted) DESC) rank')->groupBy('user_id')->get()->filter(function ($item) use($user_id) { return $item->user_id == $user_id; })->first();

        $review['rank']['projects'] = $review['rank']['projects'] ? $review['rank']['projects']->rank : $latest;
        $review['rank']['projects_view'] = $review['rank']['projects_view'] ? $review['rank']['projects_view']->rank : $latest;
        $review['rank']['projects_end'] = $review['rank']['projects_end'] ? $review['rank']['projects_end']->rank : $latest;
        $review['rank']['follow_cnt'] = $review['rank']['follow_cnt'] ? $review['rank']['follow_cnt']->rank : $latest;
        $review['rank']['followed_cnt'] = $review['rank']['followed_cnt'] ? $review['rank']['followed_cnt']->rank : $latest;
        $review['rank']['invites'] = $review['rank']['invites'] ? $review['rank']['invites']->rank : $latest;

        $review['total_ranking'] = 1;

        return $review;
    }
}
