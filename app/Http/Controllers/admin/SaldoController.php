<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:saldo-list|saldo-create|saldo-edit|saldo-delete', ['only' => ['index','show']]);
        $this->middleware('permission:saldo-create', ['only' => ['create','store']]);
        $this->middleware('permission:saldo-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:saldo-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $saldos = Saldo::latest()->paginate(4);
        $users = User::where('id', '!=', auth()->id())->get();

        return view('admin.saldos.index',compact('saldos', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['saldo'] = $request->saldo;

        $user = request()->input('input');
        $user_data = explode('-', $user);


        $input['user_id'] = $user_data[0];
        $input['name'] = $user_data[1];

        // dd($input);
        $saldo = Saldo::create($input);
        $saldo->save();

        return redirect('/saldos')
                        ->with('success','saldo created successfully');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'saldo' => 'required'
        ]);

        $saldo = Saldo::find($id);

        $saldo->saldo = $request->input('saldo');
            // dd($saldo);
        $saldo->save();

        return redirect('/saldos')->with('success', 'saldo update');
    }

    public function destroy($id)
    {
        Saldo::find($id)->delete();
        return redirect('/saldos')
                        ->with('success','User deleted successfully');
    }
}
