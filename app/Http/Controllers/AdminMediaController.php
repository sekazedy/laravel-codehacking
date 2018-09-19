<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Photo;

class AdminMediaController extends Controller
{
    public function index() {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function upload() {
        return view('admin.media.upload');
    }

    public function store(Request $request) {
        $file = $request->file('file');
        $name = date("Y-m-d H-i-s ", time()) . $file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['file_path' => $name]);

        Session::flash('message', 'The photos has been uploaded!');
        Session::flash('alert-class', 'alert-success');
    }

    public function destroy($id) {
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file_path);
        $photo->delete();

        Session::flash('message', 'The photo has been deleted!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/media');
    }
}
