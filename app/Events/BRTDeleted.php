<?php

namespace App\Events;

use App\Models\Brt;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BRTDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $brt;
    /**
     * Create a new event instance.
     */
    public function __construct(Brt $brt)
    {
        $this->brt = $brt;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->brt->user_id),
        ];
    }

    public function broadcastAs()
    {
        return 'BRTDeleted';
    }
}
