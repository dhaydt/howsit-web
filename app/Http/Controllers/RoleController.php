<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assign(){
        $user = User::find(auth()->id());
        $user->assignRole('Admin');
    }
}
