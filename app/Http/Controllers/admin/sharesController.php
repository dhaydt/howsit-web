<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;

class sharesController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $shares = Share::latest()->paginate(4);
        $users = User::where('id', '!=', auth()->id())->get();
        $senders = User::all();

        return view('admin.shares.index', compact('shares', 'users', 'senders'))
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
            'share' => 'required',
        ]);

        $input = $request->all();
        // dd($input);
        $input['share'] = $request->share;
        $input['from'] = $request->sender;

        $user = request()->input('input');
        $user_data = explode('-', $user);

        $sender = request()->input('sender');
        $sender_data = explode('-', $sender);

        $input['user_id'] = $user_data[0];
        $input['name'] = $user_data[1];

        $input['from_id'] = $sender_data[0];
        $input['from'] = $sender_data[1];

        // dd($input);
        $shares = Share::create($input);
        $shares->save();

        return redirect('/shares')
                        ->with('success', 'shares created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'share' => 'required',
        ]);

        $share = Share::find($id);
        // dd($request);

        $share->share = $request->input('share');
        // dd($saldo);
        $share->save();

        return redirect('/shares')->with('success', 'shares updated');
    }

    public function destroy($id)
    {
        Share::find($id)->delete();

        return redirect('/shares')
                        ->with('success', 'shares deleted successfully');
    }
}
