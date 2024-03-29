<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($NewMessage)
    {
        $this->message=$NewMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chatroom.'.$this->message->group->id);
    }

    public function broadcastWith()
    {
      return [
        'content' => $this->message->content,
        'created_at' => $this->message->created_at,
        'image'=>$this->message->image,
        'user' => [
          'name' => $this->message->user->name
         ]
      ];
    }

}


