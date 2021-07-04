<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Validator;

class APIFeedController extends Controller
{
    public function index()
    {
        $images = Image::all();
        $comments = Comment::all();
        $users = User::all();

        $liked = User::join('image_user', 'image_user.user_id', '=', 'users.id')
        ->join('images', 'images.id', '=', 'image_user.image_id')
        ->get(['images.id', 'images.image', 'images.created_at', 'users.name', 'users.profile_image', 'image_user.user_id', 'image_user.image_id']);

        return response()->json(['data' => $images,
        'liked' => $liked,
            'comments' => $comments,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => '',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if ($files = $request->file('image')) {
            $image_new_name = time().$files->getClientOriginalName();
            //store file into document folder
            $files->move('images', $image_new_name);

            //store your file into database
            $post = new Image();
            $post->image = 'images/'.$image_new_name;
            $post->user_id = $request->id;
            $post->name = $request->name;
            $post->caption = $request->caption;
            $post->save();

            return response()->json([
                'success' => true,
                'message' => 'File successfully uploaded',
                'image' => $image_new_name,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $image = Image::find($request->id);
        $destinationPath = public_path('/');
        File::delete($destinationPath.$image->image);
        $image->delete();
        // Log::info(json_encode($destinationPath.$image->image));

        return response()->json([
            'destroy' => true,
            'message' => 'File successfully deleted',
            'image' => $image,
        ]);
    }
}
