<?php

// namespace App\Events;

// use Illuminate\Broadcasting\Channel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// class MechanicStatusUpdated implements ShouldBroadcast
// {
//     public $mechanic_id;
//     public $is_online;
//     public $shopname;
//     public $email;

//     public function __construct($mechanic)
//     {
//         $this->mechanic_id = $mechanic->id;
//         $this->is_online = $mechanic->is_online;
//         $this->shopname = $mechanic->shopname;
//         $this->email = $mechanic->email;
//     }

//     public function broadcastOn()
//     {
//         return new Channel('mechanics-status');
//     }

//     public function broadcastAs()
//     {
//         return 'MechanicStatusUpdated';
//     }
// }
