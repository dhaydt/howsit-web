<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function verify(Request $request)
    {
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
            $user = tap(User::where('phone', $data['phone']))->update(['isVerified' => true]);
            /* Authenticate user */
            Auth::login($user->first());

            return redirect()->route('home')->with(['message' => 'Phone number verified']);
        }

        return back()->with(['phone' => $data['phone'], 'error' => 'Invalid verification code entered!']);
    }

    protected function phoneVerif(Request $request)
    {
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
        // dd($twilio);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], ['to' => $data['phone']]);
        if ($verification->valid) {
            $user = tap(User::where('phone', $data['phone']))->update(['isVerified' => true]);
            /* Authenticate user */
            // Auth::login($user->first());

            return redirect()->route('reset-phone')->with(['success' => 'Phone number verified']);
        }

        return back()->with(['phone' => $data['phone'], 'error' => 'Invalid verification code entered!']);
    }
}
