<?php

use Illuminate\Support\Facades\Broadcast;

// ✅ Define private channel for users
Broadcast::channel('chat.user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.mechanic.{id}', function ($user, $id) {
    return auth('mechanic')->check() && (int) auth('mechanic')->id() === (int) $id;
});

