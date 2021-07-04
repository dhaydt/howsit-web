<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    public function index()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
    }

    public function feed()
    {
        return view('feed');
    }

    public function messenger()
    {
        return view('messenger');
    }

    public function info()
    {
        $saldos = Saldo::all();

        return view('info')->with('users', $saldos);
    }

    public function get()
    {
        $saldos = Saldo::with('user')->where('user_id', Auth::user()->id)->get();

        return response()->json($saldos);
    }

    public function setting()
    {
        return view('setting');
    }

    public function deleteModal()
    {
        $account = User::find(Auth::user()->id);

        return view('modal.delete', compact('account'));
    }

    public function destroyAccount()
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();

        if ($user->delete()) {
            return Redirect::route('home')->with('global', 'Your account has been deleted!');
        }
    }

    public function group()
    {
        return view('group');
    }

    public function furnite()
    {
        return view('furnite');
    }

    public function help()
    {
        return view('help');
    }

    public function profile()
    {
        return view('profile');
    }

    public function likeImage($image)
    {
        $user = Auth::user();

        $likedImage = $user->likedImages()->where('image_id', $image)->count();
        if ($likedImage == 0) {
            $user->likedImages()->attach($image);
        } else {
            $user->likedImages()->detach($image);
        }
        // dd($likedImage);
        return redirect()->back();
    }

    public function fileImportExport()
    {
        return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new UsersImport(), $request->file('file')->store('temp'));

        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport(Request $request)
    {
        return Excel::download(new UsersExport($request), 'users-data.csv');
    }
}
