<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeToggled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function broadcastOn()
    {
        $modelType = class_basename($this->model);
        $channelName = strtolower($modelType) . '.' . $this->model->id;
        
        if ($modelType === 'Comment') {
            // For comments, we might want to also broadcast to the topic channel
            return [
                new Channel($channelName),
                new Channel('topic.' . $this->model->topic_id)
            ];
        }
        
        return new Channel($channelName);
    }
}
