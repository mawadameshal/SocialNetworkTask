<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);


Route::get('/dashboard', [
    'uses' => 'PostController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create',
    'middleware' => 'auth'
]);

Route::post('/uploadImage', [
    'uses' => 'PostController@uploadImagePost',
    'as' => 'post.uploads',
    'middleware' => 'auth'
]);


Route::post('/uploadVideo', [
    'uses' => 'PostController@uploadVideoPost',
    'as' => 'post.uploadv',
    'middleware' => 'auth'
]);
Route::post('/createpost/{postId}/reply', [
    'uses' => 'PostController@postReply',
    'as' => 'post.reply',
    'middleware' => 'auth'
]);

