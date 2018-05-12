<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register', 'Auth\RegisterController@register');
// Route::post('login', 'Auth\LoginController@login');



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Auth\LoginController@login');
    Route::post('social_login', 'Auth\LoginController@social_login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('recover', 'Auth\ForgotPasswordController@recover');
    Route::post('refresh', 'Auth\RegisterController@refresh');
    Route::get('me', 'Auth\LoginController@me');
    Route::post('update_profile', 'API\v1\UserController@update_profile');
    Route::post('upload_avatar', 'API\v1\UserController@upload_avatar');

    //################### EDUCATION ROUTES ############################

    Route::get('educations', 'API\v1\EducationController@index');
    Route::post('education/create', 'API\v1\EducationController@create');
    Route::post('education/{id}/update', 'API\v1\EducationController@update');
});

