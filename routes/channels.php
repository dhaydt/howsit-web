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
// Broadcast::channel('notify', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('agora-online-channel', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('messages.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return $user->id === (int) $id;
});

Broadcast::channel('global-notif', function () {
    return true;
});
