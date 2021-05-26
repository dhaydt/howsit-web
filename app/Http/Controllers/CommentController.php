<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    /**

     * Store a newly created resource in storage.

     *

     * @param  IlluminateHttpRequest  $request

     * @return IlluminateHttpResponse

     */

    public function store(Request $request)

    {

    	$request->validate([

            'body'=>'required',

        ]);

        $input = $request->all();

        $input['user_id'] = auth()->user()->id;

        Comment::create($input);
        Session::flash('success', 'Comment Posted');
        return back();

    }
}
