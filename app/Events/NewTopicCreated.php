<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewTopicCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $topic;

    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    public function broadcastOn()
    {
        return new Channel('forum');
    }

    public function broadcastWith()
    {
        \Log::info('Broadcasting NewTopicCreated event', ['topic' => $this->topic]);
        return ['topic' => $this->topic];
    }
}
