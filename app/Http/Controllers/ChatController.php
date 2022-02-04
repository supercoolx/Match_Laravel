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
    protected function validator(array $data) {
        return Validator::make($data, [
            'channel_id' => 'required|int',
            'message' => 'required|string',
        ]);
    }

    //Welcome screen
    public function index(Request $request) {
        $user_id = Auth::user()->id;
        $channels = Channel::where('user_f', $user_id)->orWhere('user_s', $user_id)->get();
        return view("chat.index", compact('channels'));
    }

    //Specific channel chatting
    public function channel(Request $request, $channelId) {
        $this->readMessages($channelId);
        $user_id = Auth::user()->id;
        $channel = Channel::findOrFail($channelId);
        $opponent = $channel->opponent();
        $project = Project::find($channel->project_id);
        $messages = Message::where([['channel_id', '=', $channelId], ['from', '=', $user_id]])->orWhere([['channel_id', '=', $channelId], ['to', '=', $user_id]])->get();
        $channels = Channel::where('user_f', $user_id)->orWhere('user_s', $user_id)->get();
        return view("chat.index", compact('channel', 'channels', 'opponent', 'project', 'messages'));
    }

    //Incoming from project
    public function link(Request $request, $id) {
        $user = Auth::user();
        $project = Project::where('id', $id)->firstOrFail();
        if ($user->user_type == config("constants.user_type.agent") || $user->user_type == config("constants.user_type.company")) {
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

    protected function readMessages(int $channelId) {
        $user = Auth::user();
        Message::where('channel_id', $channelId)->where('to', $user->id)->where('read', 0)->update(['read' => 1]);
    }

    public function createMessage(Request $request) {
        $user_id = Auth::user()->id;
        $channel = Channel::find($request->channel_id);

        if($user_id == $channel->user_f) $to = $channel->user_s;
        else if($user_id == $channel->user_s) $to = $channel->user_f;
        else abort(404);

        $message = Message::create([
            'channel_id' => $request->channel_id,
            'from' => $user_id,
            'to' => $to,
            'message' => $request->message,
            'type' => $request->type ?? config("constants.chat.text"),
        ]);

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
        
        $user_id = Auth::user()->id;
        $channel = Channel::find($request->channel_id);

        if($user_id == $channel->user_f) $to = $channel->user_s;
        else if($user_id == $channel->user_s) $to = $channel->user_f;
        else abort(404);

        $message = Message::create([
            'channel_id' => $request->channel_id,
            'from' => $user_id,
            'to' => $to,
            'message' => $request->message,
            'type' => $request->type ?? config("constants.chat.text"),
        ]);

        $message->save();
        
        return response()->json($message);
    }

    public function setting(Request $request) {
        if($request->isMethod('post')) {
            $user = User::find(Auth::user()->id);
            $user->chat_mail = $request->email;
            $user->save();
            return redirect()->back();
        }
        else return view('chat.setting');
    }
}
