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
    $router->resource('categories', CategoryController::class);
    $router->resource('subjects', SubjectController::class);
    $router->resource('courses', CourseController::class);
    $router->resource('classes', KlassesController::class);
    $router->resource('bank_accounts', UserBankAccountController::class);
});
