<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', [
    'as'    => 'home.post',
    'uses'  => 'HomeController@post'
]);

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin', 'AdminController@index');

    Route::resource('admin/users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'destroy' => 'admin.users.destroy',
        'update' => 'admin.users.update',
        'show' => 'admin.users.show',
    ]]);
    Route::resource('admin/posts', 'AdminPostsController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'destroy' => 'admin.posts.destroy',
        'update' => 'admin.posts.update',
        'show' => 'admin.posts.show',
    ]]);
    Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'destroy' => 'admin.categories.destroy',
        'update' => 'admin.categories.update',
        'show' => 'admin.categories.show',
    ]]);

    Route::get('admin/media', [
        'as'    => 'admin.media.index',
        'uses'  => 'AdminMediaController@index'
    ]);
    Route::get('admin/media/upload', [
        'as'    => 'admin.media.upload',
        'uses'  => 'AdminMediaController@upload'
    ]);
    Route::post('admin/media/store', [
        'as'    => 'admin.media.store',
        'uses'  => 'AdminMediaController@store'
    ]);
    Route::delete('admin/media/destroy/{id}', [
        'as'    => 'admin.media.destroy',
        'uses'  => 'AdminMediaController@destroy'
    ]);
    Route::delete('admin/media/delete_checked', [
        'as'    => 'admin.media.delete_checked',
        'uses'  => 'AdminMediaController@deleteChecked'
    ]);

    Route::resource('comments', 'PostCommentsController', ['names' => [
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'edit' => 'admin.comments.edit',
        'destroy' => 'admin.comments.destroy',
        'update' => 'admin.comments.update',
        'show' => 'admin.comments.show',
    ]]);
    Route::resource('comment/replies', 'CommentRepliesController', ['names' => [
        'index' => 'admin.comment.replies.index',
        'create' => 'admin.comment.replies.create',
        'store' => 'admin.comment.replies.store',
        'edit' => 'admin.comment.replies.edit',
        'destroy' => 'admin.comment.replies.destroy',
        'update' => 'admin.comment.replies.update',
        'show' => 'admin.comment.replies.show',
    ]]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});