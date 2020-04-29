<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('/faculty')->group(function () {
    
    Route::get('/','AuthFaculty\LoginController@showLoginForm')->name('faculty.login');
    Route::post('/','AuthFaculty\LoginController@login');
    Route::post('/logout','AuthFaculty\LoginController@logout')->name('faculty.logout');
    Route::get('/register','AuthFaculty\RegisterController@showRegistrationForm')->name('faculty.register');
    // Route::post('/register','AuthFaculty\RegisterController@register');

});

Route::group(['prefix'=>'faculty','middleware'=>  ['auth:faculty'] ], function () {
    Route::get('/home','Faculty\FacultyController@index')->name('faculty.home');

    Route::get('/course','Faculty\QuestionController@course_list')->name('course_list');
    Route::get('/course/view/{id}','Faculty\QuestionController@course_view')->name('course_view');
    Route::match(['get','post'],'/course/create/{id}','Faculty\QuestionController@create_question')->name('create_question');
    Route::post('/course/submit','Faculty\QuestionController@submit_question')->name('submit_question');
    Route::get('/course/edit/{id}','Faculty\QuestionController@edit_question')->name('edit_question');
    Route::delete('/course/delete/{id}','Faculty\QuestionController@delete_question')->name('delete_question');

    Route::get('/questionpaper/create/{id}','Faculty\QuestionpaperController@create_questionpaper')->name('create_questionpaper');
    Route::match(['get','post'],'/questionpaper/create/step2/{id}','Faculty\QuestionpaperController@create_questionpaper2')->name('create_questionpaper2');
    Route::match(['get','post'],'/questionpaper/create/step3/{id}','Faculty\QuestionpaperController@create_questionpaper3')->name('create_questionpaper3');

    Route::get('/questionpaper/view/{id}','Faculty\QuestionpaperController@questionpaper_view')->name('questionpaper_view');
    Route::get('/questionpaper/design/view/{id}','Faculty\QuestionpaperController@questionpaper_design_view')->name('questionpaper_design_view');
    Route::post('/questionpaper/designprint/view/{id}','Faculty\QuestionpaperController@questionpaper_designprint_view')->name('questionpaper_designprint_view');
    Route::post('/questionpaper/submit/{id}','Faculty\QuestionpaperController@submit_questionpaper')->name('submit_questionpaper');
    Route::post('/questionpaper/submit','Faculty\QuestionpaperController@submit_question_paper')->name('submit_question_paper');

    
});

Route::prefix('/admin')->group(function () {
    Route::get('/','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/','AuthAdmin\LoginController@login');
    Route::post('/logout','AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/register','AuthAdmin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register','AuthAdmin\RegisterController@register');

});

Route::group(['prefix'=>'admin','middleware'=>  ['auth:admin'] ], function () {
    Route::get('/home','Admin\AdminController@index')->name('admin.home');
    Route::resource('course','Admin\CourseController');
    Route::resource('faculty','Admin\FacultyController');
});
