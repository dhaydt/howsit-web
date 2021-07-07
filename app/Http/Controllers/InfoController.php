<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('info')->with('user');
        dd($users);
    }

    public function get()
    {
        $user = auth()->user();

        return response()->json($user);
    }

    public function getLoans()
    {
        $loans = Loan::where('user_id', '=', auth()->id())->get();

        $sum = $loans->sum('loan');

        return response()->json(['loans' => $loans,
        'sum' => $sum,
        ]);
    }
}
