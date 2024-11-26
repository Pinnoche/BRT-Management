<?php

use Illuminate\Support\Facades\Broadcast;

/*
 |--------------------------------------------------------------------------
 | Broadcast Channels
 |--------------------------------------------------------------------------
 |
 | Here you may register all of the event broadcasting channels that your
 | application supports. The given channel authorization callbacks are
 | used to check if an authenticated user can listen to the channel.
 |
 */

// Broadcast::channel('user.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('brt_creation', function () {
    return true; 
});

Broadcast::channel('brt_update', function () {
    return true; 
});

Broadcast::channel('brt_delete', function () {
    return true; 
});
