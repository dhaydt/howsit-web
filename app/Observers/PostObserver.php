<?php

// namespace App\Observers;

// use App\Models\Image;
// use App\Models\User;
// use App\Notifications\NewPost;

// class PostObserver
// {
//     public function created(Image $image)
//     {
//         $author = $image->user;
//         $users = User::all();
//         foreach ($users as $user) {
//             $user->notify(new NewPost($image, $author));
//         }
//     }
// }
