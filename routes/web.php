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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::any('/test', 'HomeController@test');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],function ($router){
    // 后台首页路由
    require(__DIR__.'/Routes/HomeRoute.php');
    // 菜单路由
    require(__DIR__.'/Routes/MenuRoute.php');
    // 权限路由
    require(__DIR__.'/Routes/PermissionRoute.php');

});