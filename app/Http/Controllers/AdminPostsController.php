<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Http\Requests\PostCreateRequest;

use Auth;

use App\Post;
use App\Photo;
use App\Category;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = $user->id;

        if ($file = $request->file('photo_id')) {
            $name = date("Y-m-d H-i-s ", time()) . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file_path' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        Session::flash('message', 'The post has been created!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('photo_id')) {
            $name = date("Y-m-d H-i-s ", time()) . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file_path' => $name]);
            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        Session::flash('message', 'The post has been updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        unlink(public_path() . $post->photo->file_path);
        $post->delete();

        Session::flash('message', 'The post has been deleted!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/posts');
    }

    public function post($id) {
        $post = Post::findOrFail($id);

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments'));
    }
}
