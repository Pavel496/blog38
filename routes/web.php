<?php

Route::get('email', function(){
  return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
});

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

Route::group([
  'prefix' => 'admin',
  'namespace' => 'Admin',
  'middleware' => 'auth'],
function(){
  Route::get('/', 'AdminController@index')->name('dashboard');

  Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
  Route::resource('users', 'UsersController', ['as' => 'admin']);

  Route::put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
  Route::put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');
  // Route::get('posts', 'PostsController@index')->name('admin.posts.index');
  // Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
  // Route::post('posts', 'PostsController@store')->name('admin.posts.store');
  // Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
  // Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
  // Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');

  Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.update');
  Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
