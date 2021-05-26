<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
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
        $saldos = Saldo::all();

        // $contacts = User::where('id', '!=', auth()->id())->get();
        // dd($users);
        // $saldo =response()->json([
        //     'users' => $user,
        // ], 200);
        // dd($saldo.'saldo');

        return view('info')->with('users', $saldos);


    }

    public function get(){
        $saldos = Saldo::with('user')->where('user_id', Auth::user()->id)->get();


        return response()->json($saldos);
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
