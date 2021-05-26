<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;

class InfoController extends Controller
{
    public function index() {

        $users = User::all();

        return view('info')->with('user');
        dd($users);

    }

    public function get() {

        $user = auth()->user();

        return response()->json($user);

    }
}
