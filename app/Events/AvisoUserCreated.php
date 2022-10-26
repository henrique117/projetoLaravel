<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\AvisoUser;

class AvisoUserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $avisoUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AvisoUser $avisoUser)
    {
        $this->avisoUser = $avisoUser;
    }

    public function getAvisoUser()
    {
        return $this->avisoUser;
    }
}
