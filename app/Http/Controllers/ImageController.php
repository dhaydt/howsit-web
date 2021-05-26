<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index() {

        $images = Image::all();


        // $users = User::all();
        // foreach($users as $user);
        // dd($user->name);

        // $users = Image::with('get_users')->get();
        // dd($images);

        $sorted = $images->sortByDesc('created_at');

        $sorted->all();

        // dd($sorted);
        // return $user;
        return view('home')->with('images', $sorted);
    }

    public function post(Request $request) {

        $this->validate($request, [
            'image' => 'required',
            'caption' => ''
        ]);

        $images = $request->image;
        $caption = $request->caption;
        foreach ($images as $image) {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('images', $image_new_name);
            $post = new Image;
            $post->user_id = Auth::user()->id;
            $post->image = 'images/' . $image_new_name;
            $post->caption = $caption;
            $post->name = Auth::user()->name;
            $post->save();
        }
        Session::flash('success', 'Image Posted');
        return redirect('/home');


            // $this->validate($request, [
            //     'image' => 'required',
            //     'caption' => '',
            // ]);

            // $input=$request->all();
            // // dd($input);
            // $images=array();
            // $userid = Auth::user()->id;
            // if($files=$request->file('images')){
            //     foreach($files as $file){
            //         $name= time() . $file->getClientOriginalName();
            //         $file->move('images',$name);
            //         $images[]=$name;
            //     }

            // }
            // /*Insert your data*/

            // Image::insert( [
            //     'image'=>  implode("|",$images),
            //     'caption' =>$input['caption'],
            //     'user_id' => $userid,
            //     //you can put other insertion here
            // ]);


            // return redirect('/');

    }

    public function destroy(Request $request) {

        $image = Image::find($request->id);
        $destinationPath = public_path('/');
        File::delete($destinationPath.$image->image);
        $image->delete();
        // Log::info(json_encode($destinationPath.$image->image));

        Session::flash('success', 'Image Deleted');
        return redirect('/home');
    }
}
