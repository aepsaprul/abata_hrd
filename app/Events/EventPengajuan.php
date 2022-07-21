<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventPengajuan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nama_pengajuan;

    public function __construct($nama_pengajuan)
    {
        $this->nama_pengajuan = $nama_pengajuan;
    }

    public function broadcastOn()
    {
        return ['pengajuan-channel'];
    }

    public function broadcastAs()
    {
        return 'pengajuan-event';
    }
}
