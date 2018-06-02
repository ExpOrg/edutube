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
    Route::get('courses', 'Auth\RegisterController@getCourses');
    Route::get('me', 'Auth\LoginController@me');
    Route::post('update_profile', 'API\v1\UserController@update_profile');
    Route::post('upload_avatar', 'API\v1\UserController@upload_avatar');

    //################### EDUCATION ROUTES ############################

    Route::get('educations', 'API\v1\EducationController@index');
    Route::post('education/create', 'API\v1\EducationController@create');
    Route::post('education/{id}/update', 'API\v1\EducationController@update');

    //################### COURSE ROUTES ############################

    Route::get('courses', 'API\v1\CourseController@index');
    Route::post('course/create', 'API\v1\CourseController@create');
    Route::post('course/{id}/update', 'API\v1\CourseController@update');
    Route::get('courses/{id}', 'API\v1\CourseController@show'); 
    Route::get('courses/{id}/details', 'API\v1\CourseController@details');
    Route::post('courses/{id}/upload_file', 'API\v1\CourseController@upload_file');
    Route::post('courses/{id}/add_category', 'API\v1\CourseController@add_category');
    Route::post('courses/{id}/remove_category', 'API\v1\CourseController@remove_category');
    Route::get('courses/{id}/edit_course', 'API\v1\CourseController@edit');
    Route::get('search', 'API\v1\CourseController@search');
    Route::get('courses/{id}/related_course', 'API\v1\CourseController@related_course');

    //################### EXPERIENCE ROUTES ############################

    Route::get('experiences', 'API\v1\ExperienceController@index');
    Route::post('experience/create', 'API\v1\ExperienceController@create');
    Route::post('experience/{id}/update', 'API\v1\ExperienceController@update');

    //################### EXPERIENCE ROUTES ############################

    Route::get('languages', 'API\v1\LanguageController@index');
    Route::post('language/create', 'API\v1\LanguageController@create');
    Route::post('language/{id}/update', 'API\v1\LanguageController@update');

    //################### CATEGORY ROUTES ############################
    Route::get('categories', 'API\v1\CategoryController@index');
    Route::get('categories/{id}', 'API\v1\CategoryController@show');
});

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'v1'

// ], function ($router) {
//     //################### CATEGORY ROUTES ############################
//     Route::get('categories', 'API\v1\CategoryController@index');
//     Route::get('categories/{id}', 'API\v1\CategoryController@show');
// })

