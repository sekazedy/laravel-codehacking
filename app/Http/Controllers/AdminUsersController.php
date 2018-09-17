<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        if (trim($request->password) == '')
            $input = $request->except('password');
        else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        if ($file = $request->file('photo_id')){
            $name = date("Y-m-d H-i-s ", time()) . $file->getClientOriginalName();
            $file->move('images', $name);   // move to images folder (that will be created automatically)
            $photo = Photo::create(['file_path' => $name]);
            $input['photo_id'] = $photo->id;
        }

        User::create($input);

        Session::flash('message', 'The user has been created!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        if (trim($request->password) == '')
            $input = $request->except('password');
        else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        $user = User::findOrFail($id);

        if ($file = $request->file('photo_id')){
            $name = date("Y-m-d H-i-s ", time()) . $file->getClientOriginalName();
            $file->move('images', $name);   // move to images folder (that will be created automatically)
            $photo = Photo::create(['file_path' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        Session::flash('message', 'The user has been updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        unlink(public_path() . $user->photo->file_path);
        $user->delete();

        Session::flash('message', 'The user has been deleted!');
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/users');
    }
}
