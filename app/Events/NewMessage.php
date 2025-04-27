<?php

// namespace App\Events;

// use App\Models\Message;
// use App\Models\User;
// use App\Models\Mechanic;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// class NewMessage implements ShouldBroadcast
// {
//     public $message;
//     public $mechanic;
//     public $user;

//     public function __construct(Message $message, $receiver)
//     {
//         $this->message = $message;

//         if ($message->receiver_type === 'user') {
//             $this->user = $receiver;
//         } else {
//             $this->mechanic = $receiver;
//         }
//     }

//     public function broadcastOn()
//     {
//         if ($this->message->receiver_type === 'user') {
//             return new PrivateChannel('user.' . $this->message->receiver_id);
//         }

//         return new PrivateChannel('mechanic.' . $this->message->receiver_id);
//     }

//     public function broadcastAs()
//     {
//         return 'NewMessage';
//     }
// }
