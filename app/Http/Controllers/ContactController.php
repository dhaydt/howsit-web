<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function get() {

        //get all user kecuali user
        $contacts = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getMessagesFor($id) {

        //mark all messages as read with selected contact

        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        $messages = Message::where('from', $id)->orWhere('to', $id)->get();

        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })-> orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        if(request()->has('file')){
            $fileName = request('file')->store('chat');
            $message = Message::create([
                'from' => auth()->id(),
                'to' => $request->contact_id,
                // 'text' => $request->text,
                'image' => $fileName
            ]);
        } else {
            $message = Message::create([
                'from' => auth()->id(),
                'to' => $request->contact_id,
                'text' => $request->text,
                'image' => $request->image
            ]);
        }

        broadcast(new NewMessage($message));

        return response()->json($message);
    }

    public function sendMMS($id)
    {
        $to = ($id);
        $filename = request('file')->store('chat');
            $message=Message::create([
                'from' => request()->user()->id,
                'image' => $filename,
                'to' => $to,
            ]);

            broadcast(new NewMessage($message));

            return response()->json($message);
    }

    public function sender(){

    }
}
