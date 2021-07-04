<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:feed-list|feed-create|feed-edit|feed-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:feed-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:feed-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:feed-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::latest()->paginate(4);

        return view('admin.feeds.index', compact('images'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'caption' => '',
        ]);

        $images = $request->image;
        $caption = $request->caption;
        foreach ($images as $image) {
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('images', $image_new_name);
            $post = new Image();
            $post->user_id = Auth::user()->id;
            $post->image = 'images/'.$image_new_name;
            $post->caption = $caption;
            $post->name = Auth::user()->name;
            $post->save();
        }
        Session::flash('success', 'Image Posted');

        return redirect('/feeds')
                        ->with('success', 'Feed created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        return view('admin.feeds.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return view('admin.feeds.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $image->update($request->all());

        return redirect('feeds.index')
                        ->with('success', 'Images updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image, $id)
    {
        $image = Image::find($id);
        $destinationPath = public_path('/');
        File::delete($destinationPath.$image->image);
        $image->delete();

        return redirect('/feeds')
                        ->with('success', 'Product deleted successfully');
    }
}
