<?php

namespace App\Events;

use App\Models\Brt;
use Illuminate\Broadcasting\Channel;
use App\Notifications\BrtNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Support\Facades\Notification;
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
            new Channel( 'brt_delete'),
        ];
    }

    public function broadcastAs()
    {
        return 'BRTDeleted';
    }

    public function broadcastWith(): array
    {
        $formattedMessage = "{$this->brt->brt_code} [\$BLU] {$this->brt->reserved_amount}\$BLU has been deleted.";

        return [
            'brt_code' => $this->brt->brt_code,
            'reserved_amount' => $this->brt->reserved_amount,
            'status' => $this->brt->status,
            'message' => $formattedMessage,
        ];
    }
}
