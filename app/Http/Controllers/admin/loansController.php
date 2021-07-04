<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;

class loansController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $loans = Loan::latest()->paginate(4);
        $users = User::where('id', '!=', auth()->id())->get();
        $to = User::all();

        return view('admin.loans.index', compact('loans', 'users', 'to'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $saldo = Saldo::find($id);

        return view('admin.shares.show', compact('saldo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'loan' => 'required',
        ]);

        $input = $request->all();
        // dd($input);
        $input['loan'] = $request->loan;
        $input['to'] = $request->to;

        $user = request()->input('input');
        $user_data = explode('-', $user);

        $to = request()->input('to');
        $to_data = explode('-', $to);

        $input['user_id'] = $user_data[0];
        $input['name'] = $user_data[1];

        $input['to_id'] = $to_data[0];
        $input['to'] = $to_data[1];

        // dd($input);
        $loans = Loan::create($input);
        $loans->save();

        return redirect('/loans')
                        ->with('success', 'Loans has been created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'loan' => 'required',
        ]);

        $loans = Loan::find($id);
        // dd($request);

        $loans->loan = $request->input('loan');
        // dd($saldo);
        $loans->save();

        return redirect('/loans')->with('success', 'Loans updated');
    }

    public function destroy($id)
    {
        Loan::find($id)->delete();

        return redirect('/loans')
                        ->with('success', 'Loans deleted successfully');
    }
}
