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

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', 'ArticleController@index');
Route::get('articles/{article}', 'ArticleController@show');

Route::prefix('admin')->group(function(){
    Route::get('/', 'Admin\IndexController@index');

    Route::resource('articles', 'Admin\ArticleController', [
        'names'=>[
            'index'=>'admin.articles.index',
            'show'=>'admin.articles.show',
            'create'=>'admin.articles.create',
            'store'=>'admin.articles.store',
            'edit'=>'admin.articles.edit',
            'update'=>'admin.articles.update',
            'destroy'=>'admin.articles.destroy',
        ]
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
