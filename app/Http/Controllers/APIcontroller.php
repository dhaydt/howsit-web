<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIcontroller extends Controller
{
    public function index()
    {
        return view('home');
    }

    public $successStatus = 200;

    public function login(Request $request)
    {
        if (Auth::attempt($this->credentials($request))) {
            $user = Auth::user();
            $success['token'] = $user->createToken('nApp')->accessToken;

            return response()->json(['status' => 'true', 'success' => $success], $this->successStatus);
        } else {
            return response()->json(['status' => 'false', 'message' => 'Email atau password salah'], 401);
        }
    }

    public function credentials(Request $request)
    {
        if (\is_numeric($request->get('email'))) {
            return ['phone' => $request->get('email'), 'password' => $request->get('password')];
        }

        return ['email' => request('email'), 'password' => request('password')];
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required_without:phone|nullable|email',
            'phone' => 'required_without:email|nullable|string',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('nApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if ($logout) {
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        }
    }

    public function details()
    {
        $user = Auth::user();

        return response()->json(['success' => $user], $this->successStatus);
    }
}
