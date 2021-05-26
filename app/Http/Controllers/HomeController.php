<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
    }

    public function feed(){

        return view('feed');

    }

    public function messenger() {

        return view('messenger');

    }

    public function info() {
        $users = User::all();

        return view('info')->with('user');

    }

    public function setting() {

        return view('setting');

    }

    public function group() {

        return view('group');

    }

    public function furnite() {

        return view('furnite');

    }

    public function help() {

        return view('help');

    }

    public function profile() {
        return view('profile');
    }

    public function likeImage($image) {
        $user = Auth::user();

        $likedImage = $user->likedImages()->where('image_id', $image)->count();
        if($likedImage == 0){
            $user->likedImages()->attach($image);
        } else {
            $user->likedImages()->detach($image);
        }
        // dd($likedImage);
        return redirect()->back();
    }
}
