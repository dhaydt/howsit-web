<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;

class moneyController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $money = Money::latest()->paginate(4);
        $users = User::where('id', '!=', auth()->id())->get();

        return view('admin.money.index', compact('money', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $saldo = Money::find($id);

        return view('admin.money.show', compact('saldo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'money' => 'required',
        ]);

        $input = $request->all();
        $input['money'] = $request->money;
        // dd($input);
        $user = request()->input('input');
        $user_data = explode('-', $user);

        $input['user_id'] = $user_data[0];
        $input['name'] = $user_data[1];

        // dd($input);
        $money = Money::create($input);
        $money->save();

        return redirect('/money')
                        ->with('success', 'successfully added money');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'money' => 'required',
        ]);

        $money = Money::find($id);

        $money->money = $request->input('money');
        // dd($request);
        $money->save();

        return redirect('/money')->with('success', 'money was updated');
    }

    public function destroy($id)
    {
        Money::find($id)->delete();

        return redirect('/money')
                        ->with('success', 'money deleted successfully');
    }
}
