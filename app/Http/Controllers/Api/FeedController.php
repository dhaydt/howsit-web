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

class FeedController extends Controller
{
    public function index()
    {
        $images = Image::all();
        $comments = Comment::all();
        $users = User::all();
        $sorted = $images->sortByDesc('created_at');

        $sorted->all();

        // return view('home')->with('images', $sorted);
        return response()->json(['data' => $images, $sorted,
            'comments' => $comments,
            'users' => $users,
        ]);
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'caption' => '',
        ]);

        $images = $request->image;
        $caption = $request->caption;
        foreach ($images as $image) {
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('images', $image_new_name);
            $post = new Image();
            $post->user_id = Auth::user()->id;
            $post->image = 'images/'.$image_new_name;
            $post->caption = $caption;
            $post->name = Auth::user()->name;
            $post->save();
        }
        Session::flash('success', 'Image Posted');

        return redirect('/home');
    }

    public function destroy(Request $request)
    {
        $image = Image::find($request->id);
        $destinationPath = public_path('/');
        File::delete($destinationPath.$image->image);
        $image->delete();
        // Log::info(json_encode($destinationPath.$image->image));

        Session::flash('success', 'Image Deleted');

        return redirect('/home');
    }
}
