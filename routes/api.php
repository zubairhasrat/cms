<?php

use Illuminate\Http\Request;



// Route::get('/', function () {
//     return view('index');
// });
// Route::get('admin',function(){
//     return view('home');
// });
// Route::prefix('api',['middleware' => ['auth','has_permission']])->group(function() {
//     Route::resource('/category', 'CategoryController');
//     Route::resource('/getCategories', 'CategoryController');
//     Route::resource('/deletecategory', 'CategoryController');
//     Route::resource('users', 'UserController');
//     Route::resource('addusers', 'UserController');
//     Route::resource('deleteuser', 'UserController');
//     Route::resource('edituser', 'UserController');
//     Route::get('authuser', 'UserController@getAuthUser');
//     Route::resource('getsingleuser', 'UserController');
//     Route::resource('roles', 'RoleController');
//     Route::resource('addRoles', 'RoleController');
//     Route::resource('deleterole', 'RoleController');
//     Route::resource('editrole', 'RoleController');
//     Route::resource('addposts', 'PostController');
//     Route::resource('posts', 'PostController');
//     Route::resource('editposts', 'PostController');
//     Route::resource('deletepost', 'PostController');
//     Route::resource('permissions','PermissionController');
//     Route::resource('Addpermissions','PermissionController');
//     Route::resource('editpermission','PermissionController');
//     Route::resource('deletepermission','PermissionController');
//     Route::resource('addcomment','CommentController');
//     Route::resource('getcomments','CommentController');
//     Route::resource('aprovecomment','CommentController');
//     Route::resource('deletecomment','CommentController');
// });

// Auth::routes();
// // Route::prefix('api')->group( function(){
// //     Route::post('register','CustomAuthController@register');
// //     Route::post('login','CustomAuthController@login');
// // });

// Route::get('/home', 'HomeController@index')->name('home');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

