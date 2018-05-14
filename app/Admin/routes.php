<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('website_users', UserController::class);
    $router->resource('blogs', BlogController::class);
    $router->post('auth/login', '\App\Admin\Controllers\CustomAuthController@postLogin')->middleware(config('admin.route.middleware'));

});
