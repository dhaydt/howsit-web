<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\User;

class SaldoController extends Controller
{
    public function index()
    {
        $saldos = Saldo::all();
        $users = User::all();

        return response()->json(['data' => ['saldo' => $saldos,
        'users' => $users, ],
        ]);
    }
}
