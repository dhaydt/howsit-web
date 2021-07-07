<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $saldo = $user->saldo;

        if ($saldo == null) {
            return response()->json(['data' => ['saldo' => '0',
            'user' => $user, ],
        ]);
        }
        // dd($user);

        return response()->json(['data' => ['saldo' => $saldo->saldo,
        'user' => $user, ],
        ]);
    }

    public function getLoans()
    {
        $loans = Loan::where('user_id', '=', auth()->id())->get();

        $sum = $loans->sum('loan');

        return response()->json(['data' => $loans,
        'total' => $sum,
        ]);
    }
}
