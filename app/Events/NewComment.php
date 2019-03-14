<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewComment implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('post.' . $this->comment->post->id);
//        return new Channel('post.' . $this->comment->post->id);
    }

//    public function broadcastAs()
//    {
//        return 'customComment'; // by default it will be as class name: 'NewComment'
//    }
    /*
     *
     * https://www.youtube.com/watch?v=UUpZlSbGs9M&list=PLwAKR305CRO9rlj-U9oOi4m2sQaWN6XA8&index=5
Denis Kotnik
6 months ago (edited)
It didnt work for me. After I changed in the following files, it started working:
- broadcasting.php: 'encrypted': false
- if you used 'broadcastAs() { return "NewComment"; }' method, you should change in show.blade.php: .listen('.NewComment'). Check the Laravel documentation about that dot.﻿
     *
     * //ss I've checked this case (for custom channel names via broadcastAs), and found this:
     * 1. don't need to disable encryption from 'config/broadcasting.php/pusher.options.encrypted', and can just use as 'encrypted => true'
     * 2. recommended to have channel names without any dashes symbols (only alphabetical characters)
     * 3. in blade need to start with "." (dot) symbol for custom broadcast channel names
     */

    public function broadcastWith()
    {
        return [
            'body' => $this->comment->body,
            'created_at' => $this->comment->created_at->toFormattedDateString(),
            'user' => [
                'name' => $this->comment->user->name,
                'avatar' => 'http://lorempixel.com/50/50'
            ]
        ];
    }
}
