<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Twilio\Rest\Client;

class ProfileController extends Controller
{
    public function phoneVerify()
    {
        $user = Auth::user();
        $phone = $user->phone;

        $token = getenv('TWILIO_AUTH_TOKEN');
        $twilio_sid = getenv('TWILIO_SID');
        $twilio_verify_sid = getenv('TWILIO_VERIFY_SID');
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phone, 'sms');

        return redirect()->route('verify')->with([$phone]);
    }

    public function profile()
    {
        return view('avatar', ['user' => Auth::user()]);
    }

    public function forgotVerify(Request $request)
    {
        $data = $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $user = User::wherePhone($request->phone)->first();

        if ($user === null) {
            return redirect()->back()->with('error', 'Your phone is not registered!');
        }

        $phone = $user->phone;
        // dd($phone);

        $token = getenv('TWILIO_AUTH_TOKEN');
        $twilio_sid = getenv('TWILIO_SID');
        $twilio_verify_sid = getenv('TWILIO_VERIFY_SID');
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phone, 'sms');

        return view('auth.otpCheck')->with(['phone' => $phone]);
    }

    public function updateAvatar(Request $request)
    {
        // Handle the user upload of avatar
        if ($request->hasFile('profile_image')) {
            $avatar = $request->file('profile_image');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/images/profile/'.$filename));

            $user = Auth::user();
            $user->profile_image = $filename;
            // dd($user);
            $user->save();
        }

        return view('avatar', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $request->user()->update(
            $request->all()
        );

        return redirect()->route('profile')->with('success', 'profile updated');
    }
}
