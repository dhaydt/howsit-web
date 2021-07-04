<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class BackupCloudController extends Controller
{
    public function googleDrive()
    {
        Storage::disk('google')->put('test.txt', 'Hello World');

        return redirect()->back()->with('success', 'data backup successfully');
    }
}
