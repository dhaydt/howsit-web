<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\SendsPasswordResetOtp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;

class ResetPhoneController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.phone');
    }

    public function postForget(Request $request)
    {
        $this->validatePhone($request);

        $user = User::wherePhone($request->phone)->first();
        // dd($user);
        $response = ('Your number is not registered');
        // $token = $user->activation_token;
        // dd($token);
        if ($user === null) {
            return redirect()->back()->with('error', 'Your phone is not registered!');
        }

        if ($user->isVerified == false) {
            return redirect()->back()->with('error', 'Your phone is not verified!');
        }
        else {
            // $token = rand(100000, 999999);
            // $user->update([
            //     'phone_token' => rand(100000, 999999),
            // ]);

            $phone = $user->phone;

            $token = getenv('TWILIO_AUTH_TOKEN');
            $twilio_sid = getenv('TWILIO_SID');
            $twilio_verify_sid = getenv('TWILIO_VERIFY_SID');
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phone, 'sms');

            // return redirect()->route('verify-phone', [$phone])->with('success', 'Your reset OTP successfully send!');
            return view('auth.passwords.verifyPhoneToken', ['phone' => $phone])->with('success', 'Your reset OTP successfully send!');
            // redirect()->route('verify-phone')->with(['phone' => $phone]);

        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Validate the email for the given request.
     *
     * @return void
     */
    protected function validatePhone(Request $request)
    {
        $request->validate(['phone' => 'required']);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('phone');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param string $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
                    ? new JsonResponse(['message' => trans($response)], 200)
                    : back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param string $response
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return back()
                ->withInput($request->only('phone'))
                ->withErrors(['phone' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    // use SendsPasswordResetOtp;

    protected function sendFailedLoginResponse(Request $request)
    {
        // $this = $request->phone;
        throw ValidationException::withMessages([
            $request->phone => [trans('Your number is not verified yet')],
        ]);
    }
}
