<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authId = Auth::id();
         // show conversation list and default conversation (optional)
        $users = User::where('id','!=',$authId)->get();
       
        foreach ($users as $user) {

            //Get last message between auth userand this user
            $last = Message::where(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $authId)
                      ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $authId);
                })
                ->latest()
                ->first();

            // Add dynamic properties
            $user->last_message = $last ? ($last->body ?? '[Image]') : null;
            $user->last_time    = $last ? $last->created_at : null;

            //Count unseen messages
            $user->unseen_count = Message::where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->where('is_seen', false)
                ->count();
        } 

       
        return view('chat.index',compact('users'));
    }

    // Return conversation messages (JSON or Blade partial)
    public function conversation(User $user)
    {
        $authId = Auth::id();

        $messages = Message::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authId, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authId);
        })->with('sender')->orderBy('created_at')->get();

        // Mark messages as seen (those sent to auth)
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $authId)
            ->where('is_seen', false)
            ->update(['is_seen' => true]);

        return response()->json($messages);
    }

    // Store a message (text or image)
    public function store(Request $request, User $user)
    {
        $request->validate([
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $authId = Auth::id();

        $data = [
            'sender_id' => $authId,
            'receiver_id' => $user->id,
            'body' => $request->body,
        ];
         $file = $request['image'];
        
        if ($request->hasFile('image')) {
             $file = $request['image'];
                
            $imageName = time().'.'.$file->extension();
            $file->move(public_path('assets/messages'),$imageName);
            $data['image'] = 'assets/messages/' . $imageName;           
            // optional: if no body, set a placeholder
            if (empty($data['body'])) {
                $data['body'] = null;
            }
        }

        $message = Message::create($data);

        // Return created message with relations
        $message->load('sender');

        return response()->json($message, 201);
    }

    // get last messages info for conversation list refresh
    public function conversationsSummary()
    {
         $authId = Auth::id();

        // Get all users except logged-in user
        $users = User::where('id', '!=', $authId)->get();

        $summary = [];

        foreach ($users as $user) {

            // Get last message between auth user and this user
            $last = Message::where(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $authId)
                      ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $authId);
                })
                ->latest()
                ->first();

            // Count unseen messages
            $unseen = Message::where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->where('is_seen', false)
                ->count();

            // Add to summary array
            $summary[] = [
                'user_id'      => $user->id,
                'name'         => $user->name,
                'last_message' => $last ? ($last->body ?? '[Image]') : null,
                'last_time'    => $last ? $last->created_at->toDateTimeString() : null,
                'unseen'       => $unseen,
            ];
        }

        return response()->json($summary);
    }
}
