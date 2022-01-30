<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use App\Models\Project;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function link(Request $request, $id) {
        $user = Auth::user();
        $project = Project::where('id', $id)->first();
        if (!$project) {
            abort(404);
        } elseif ($user->user_type == config("constants.user_type.agent") || $user->user_type == config("constants.user_type.company")) {
            if ($user->id === $project->user_id) {
                $channel = Channel::where('project_id', $id)->first();
                if ($channel) {
                    return redirect(route('chat.channel', ['channelId' => $channel->id]));
                }
                return redirect(route('chat.index'));
            } else {
                abort(404);
            }
        } elseif ($user->user_type == config("constants.user_type.engineer")) {
            $channel = Channel::where([['project_id', $id], ['user_id', $user->id]])->first();
            if ($channel) {
                return redirect(route('chat.channel', ['channelId' => $channel->id]));
            }
            $channel = new Channel([
                'project_id' => $id,
                'user_id' => $user->id,
            ]);
            $channel->save();
            return redirect(route('chat.channel', ['channelId' => $channel->id]));

        } else {
            abort(404);
        }
    }

    protected function getChannels(Request $request) {
        $user = Auth::user();
        $channels = [];
        $messages = Message::where('read', 0)
            ->where('to', $user->id)
            ->select('channel_id', DB::raw('COUNT(channel_id) as unread'))
            ->groupBy('channel_id', 'to');
        if ($user->user_type == config("constants.user_type.agent") || $user->user_type == config("constants.user_type.company")) {
            $projects = Project::select('id', 'user_id');
            $users = User::select('id', 'name', 'name_kana', 'avatar');
            $channels = Channel::joinSub($projects, 'projects', function ($join) use ($user) {
                $join->on('channels.project_id', '=', 'projects.id')
                    ->where('projects.user_id', '=', $user->id);
            })
                ->joinSub($users, 'users', function ($join){
                    $join->on('channels.user_id', '=', 'users.id');
                })
                ->leftJoinSub($messages, 'messages', function ($join){
                    $join->on('messages.channel_id', '=', 'channels.id');
                })
                ->select('channels.*', 'users.name', 'users.name_kana', 'users.avatar', 'users.id as friend_id', 'messages.unread')
                ->get();
        } elseif ($user->user_type == config("constants.user_type.engineer")) {
            $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
                ->select('projects.id', 'users.name', 'users.name_kana', 'users.avatar', 'projects.user_id');
            $channels = Channel::joinSub($projects, 'projects', function ($join) {
                $join->on('channels.project_id', '=', 'projects.id');
            })
                ->leftJoinSub($messages, 'messages', function ($join){
                    $join->on('messages.channel_id', '=', 'channels.id');
                })
                ->select('channels.*', 'projects.name', 'projects.name_kana', 'projects.avatar', 'projects.user_id as friend_id', 'messages.unread')
                ->where('channels.user_id', $user->id)->get();
        }
        return response()->json([
            'success' => true,
            'channels' => $channels
        ]);
    }

    protected function getMessages(Request $request, int $channelId) {
        if (!$this->verifyChannel($channelId)) {
            abort(404);
        }

        $search = $request->all();
        $search['latest'] = $search['latest'] ?? 0;

        $user = Auth::user();
        $messages = Message::where('channel_id', $channelId)
            ->where(function ($query) use ($user) {
                $query->where('from', '=', $user->id)
                    ->orWhere('to', '=', $user->id);
            })
            ->where('id', '>', $search['latest'])
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    public function index(Request $request) {
        $user = Auth::user();
        $channelId = 0;
        $friendId = 0;
        $friend = null;
        return view("chat.index", compact('channelId', 'user', 'friend', 'friendId'));
    }

    protected function verifyChannel(int $channelId) {
        $user = Auth::user();
        $channel = Channel::find($channelId);
        if (!$channel) {
            return false;
        }
        $project = Project::find($channel->project_id);
        if (!$project){
            return false;
        }
        if ($user->id != $project->user_id && $user->id != $channel->user_id) {
            return false;
        }
        return $user->id != $project->user_id ? $project->user_id : $channel->user_id;
    }

    protected function readMessages(int $channelId) {
        $user = Auth::user();
        Message::where('channel_id', $channelId)->where('to', $user->id)->where('read', 0)->update(['read' => 1]);
    }

    public function read(Request $request, $channelId) {
        $friendId = $this->verifyChannel($channelId);
        if (!$friendId) {
            abort(404);
        }
        $this->readMessages($channelId);
        return response()->json([
            'success' => true,
        ]);
    }

    public function channel(Request $request, $channelId) {
        $friendId = $this->verifyChannel($channelId);
        if (!$friendId) {
            abort(404);
        }
        $this->readMessages($channelId);

        $channel = Channel::find($channelId);
        $friend = User::find($friendId);
        $user = Auth::user();
        $project = Project::find($channel->project_id);
        return view("chat.index", compact('channelId', 'user', 'friend', 'friendId', 'project'));
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'channel_id' => 'required|int|max:1023',
            'message' => 'required|string',
        ]);
    }

    protected function createMessage(array $data) {
        $user = Auth::user();
        $channel = Channel::find($data['channel_id']);
        $project = Project::find($channel->project_id);
        $to = $user->id !==  $project->user_id ? $project->user_id : $channel->user_id;

        $message = Message::create([
            'channel_id' => $data['channel_id'],
            'from' => $user->id,
            'to' => $to,
            'message' => $data['message'],
            'type' => $data['type'] ?? config("constants.chat.text"),
        ]);

        return $message;
    }

    public function message(Request $request) {
        $this->validator($request->all())->validate();
        if (!$this->verifyChannel($request->channel_id)) {
            abort(404);
        }

        $message = $this->createMessage($request->all());
        $message->save();

        return response()->json($message);
    }

    public function attachment(Request $request) {
        if(!$request->file()) {
            return response()->json([
                'success' => true,
            ]);
        }
        $imageFile = $request->file('attachment');
        $name = $imageFile->getClientOriginalName();
        $extension = $imageFile->getClientOriginalExtension();
        $fileName = $imageFile->hashName();
        $imagePath = $imageFile->storeAs('share', $fileName, 'public_uploads');
        $request->merge([
            'message' => $name."|".$extension."|".$imagePath,
            'type' => config("constants.chat.file"),
        ]);
        $message = $this->createMessage($request->all());
        $message->save();
        return response()->json($message);
    }
}
