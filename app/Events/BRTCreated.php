<?php

namespace App\Events;

use App\Models\Brt;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BRTCreated implements ShouldBroadcast
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
            new Channel('brt_creation'),
        ];
    }

    public function broadcastWith(): array
    {
        $formattedMessage = "{$this->brt->brt_code} [\$BLU] {$this->brt->reserved_amount}\$BLU has been created.";

        return [
            'brt_code' => $this->brt->brt_code,
            'reserved_amount' => $this->brt->reserved_amount,
            'status' => $this->brt->status,
            'message' => $formattedMessage,
        ];
    }
}
