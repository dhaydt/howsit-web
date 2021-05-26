<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Image;
class ProfileController extends Controller
{
    public function profile() {

        return view('avatar', array('user' => Auth::user()) );
    }

    public function updateAvatar(Request $request) {

        // Handle the user upload of avatar
    	if($request->hasFile('profile_image')){
    		$avatar = $request->file('profile_image');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/images/profile/' . $filename ) );

    		$user = Auth::user();
    		$user->profile_image = $filename;
            // dd($user);
    		$user->save();
    	}

    	return view('avatar', array('user' => Auth::user()) );
    }

    public function update(Request $request) {
        $request->user()->update(
            $request->all()
        );

        return redirect()->route('profile');
    }
}
