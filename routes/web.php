<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Admin\AdminLoginController@showForm');
Route::resource('posts','PostController');
Auth::routes();

Route::prefix('/admin')->group(function(){
    Route::get('/show-form', 'Admin\AdminLoginController@showForm')->name('admin.show');
    Route::post('/registration', 'Admin\AdminLoginController@registration')->name('admin.registration');  
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin.login');
    Route::get('/', 'Admin\AdminDashboardController@index')->name('admin.dashboard');
    Route::get('/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');
});



Route::get('/admin/{rout?}', function(){
    return view('Admin');
})->where('rout', '[\/\w\.-]*');

Route::get('/home', 'HomeController@index')->name('home');
