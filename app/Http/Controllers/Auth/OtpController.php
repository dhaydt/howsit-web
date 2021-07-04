<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function index()
    {
        // dd($phone);

        return view('auth.passwords.verifyPhoneToken');
    }

    public function verify(Request $request)
    {
        // $user = User::wherePhone_token($request->phone_token)->first();
        // // dd($user);

        // if($user == null){
        //     return redirect()->back()->with('error', 'Your input OTP is wrong ! ');
        // }else {
        //     $user->update([
        //         'phone_token' => rand(100000, 999999),
        //     ]);
        //     return redirect()->route('phoneReset', [$user->phone_token])->with('success', 'Create your new password');
        // }
        // dd($request->verification_code);

        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone' => ['required', 'string'],
        ]);
        // dd($data);
        /* Get credentials from .env */
        $token = getenv('TWILIO_AUTH_TOKEN');
        $twilio_sid = getenv('TWILIO_SID');
        $twilio_verify_sid = getenv('TWILIO_VERIFY_SID');
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], ['to' => $data['phone']]);
        if ($verification->valid) {
            // $user = tap(User::where('phone', $data['phone']))->update(['isVerified' => true]);
            /* Authenticate user */
            $phone = $data['phone'];
            // dd($data);
            return view('auth.passwords.phoneReset', ['phone' => $phone])->with('success', 'Create your new password!');
            // Auth::login($user->first());

            // return redirect()->route('home')->with(['message' => 'Phone number verified']);
        }

        return back()->with(['phone' => $data['phone'], 'error' => 'Invalid verification code entered!']);
    }

    public function resetForm()
    {
        return view('auth.passwords.phoneReset');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|exists:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::wherePhone($request->phone)->first();
        // dd($user);

        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        return redirect('login')->with('success', 'Password was changed');
    }
}
