<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string $price_min
 * @property string $price_max
 * @property int|null $job_type
 * @property int|null $industry
 * @property string|null $content
 * @property string|null $required_skills
 * @property string|null $applicable_skills
 * @property string|null $required_person
 * @property string|null $team_structure
 * @property string|null $gained_skills
 * @property string|null $work_location
 * @property int|null $interviews
 * @property string|null $start_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $uptime_min
 * @property string|null $uptime_max
 * @property int|null $week
 * @property string|null $contract_type
 * @property int|null $online_interview
 * @property int|null $remote_work
 * @property string|null $comment
 * @property int|null $avatar
 * @property int|null $client
 * @property string|null $image
 * @property int $user_id
 * @property int $user_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereApplicableSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContractType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereGainedSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereInterviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereJobType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereOnlineInterview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePriceMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePriceMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereRemoteWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereRequiredPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereRequiredSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTeamStructure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUptimeMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUptimeMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereWorkLocation($value)
 * @mixin \Eloquent
 * @property int $deleted
 * @property-read \App\Models\ContractType|null $contractType
 * @property-read \App\Models\Industry|null $industries
 * @property-read \App\Models\JobType|null $jobType
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Week|null $weeks
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeleted($value)
 * @property int $status
 * @method static Builder|Project whereStatus($value)
 */
class Project extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('deleted', function (Builder $builder) {
            $builder->where('deleted', 0);
        });
    }

    protected $fillable = [
        'name',
        'price',
        'job_type',
        'industry',
        'content',
        'required_skills',
        'applicable_skills',
        'required_person',
        'team_structure',
        'gained_skills',
        'work_location',
        'interviews',
        'start_date',
        'start_time',
        'end_time',
        'uptime_min',
        'uptime_max',
        'week',
        'contract_type',
        'online_interview',
        'remote_work',
        'comment',
        'avatar',
        'client',
        'user_id',
        'user_type',
        'image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type', 'id');
    }

    public function industries()
    {
        return $this->belongsTo(Industry::class, 'industry', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'work_location', 'id');
    }

    public function weeks()
    {
        return $this->belongsTo(Week::class, 'week', 'id');
    }
}
