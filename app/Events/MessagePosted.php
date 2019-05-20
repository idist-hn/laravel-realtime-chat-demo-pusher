<?php

namespace App\Events;

namespace App\Events;

use App\Message;
use App\Room;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class MessagePosted
 * @package App\Events
 */
class MessagePosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message
     *
     * @var Message
     */
    public $message;

    /**
     * User
     *
     * @var User
     */
    public $user;

    /**
     * Room
     *
     * @var Room
     */
    public $room;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $user, Room $room)
    {
        $this->message = $message;

        $this->user = $user;

        $this->room = $room;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('room_'.$this->room->id);
    }
}
