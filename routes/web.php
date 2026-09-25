<?php

use Illuminate\Support\Facades\Route;
/*
|__________________________________________________________________________
| Web Routes
|__________________________________________________________________________
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home_admin','HomeController@index')->name('home_admin');
Route::get('/login_admin','MainController@login_admin')->name('login_admin');
/* manage admin */
Route::group(['prefix' => 'admin','middleware' => 'rule:admin'], function () {
    /* Show and edit article */
    Route::get('','AdminController@show_dashboard')->name('admin_show_dashboard');
    Route::get('view_article/{slug}','AdminController@view_article')->name('admin_view_article');
    Route::get('manager_article','AdminController@manager_article')->name('admin_manager_article');
    Route::get('create_article','AdminController@create_article')->name('admin_create_article');
    Route::post('save_article','AdminController@save_article')->name('admin_save_article');
    Route::get('delete_article/{id}','AdminController@delete_article')->name('admin_delete_article');
    Route::get('edit_article/{slug}','AdminController@edit_article')->name('admin_edit_article');
    Route::post('save_as_article/{slug}','AdminController@save_as_article')->name('admin_save_as_article');
    /* Show and delete category */
    Route::get('manager_category','AdminController@manager_category')->name('admin_manager_category');
    Route::get('create_category','AdminController@create_category')->name('admin_create_category');
    Route::post('save_category','AdminController@save_category')->name('admin_save_category');
    Route::get('edit_category/{slug}','AdminController@edit_category')->name('admin_edit_category');
    Route::post('save_as_category/{slug}','AdminController@save_as_category')->name('admin_save_as_category');
    Route::get('delete_category/{id}','AdminController@delete_category');
    /* Show and delete messenger */
    Route::get('manager_messenger','AdminController@manager_messenger')->name('admin_manager_messenger');
    Route::get('user','AdminController@show_user')->name('admin_show_user');
    Route::get('delete_messenger/{id}','AdminController@delete_messenger');    
});
/* show all main */
Route::group(['prefix' => ''], function () {
    Route::get('','MainController@view_home')->name('index');
    Route::get('home','MainController@view_home')->name('home');
    Route::get('about','MainController@view_about')->name('about');
    Route::get('experience','MainController@view_experience')->name('experience');
    Route::get('blog','MainController@view_blog')->name('blog');
    Route::get('contact','MainController@view_contact')->name('contact');
});
/* Show article */
Route::group(['prefix' => 'blog'], function () {
    /* show article in blog */
    Route::get('article/{slug}', 'BlogController@show_article')->name('show_article');
    Route::get('search', 'BlogController@search_article')->name('search_article');
    Route::get('category/{id}', 'BlogController@category_article');
    /* Show article in category */
    Route::get('category','BlogController@show_category');
    /* Show article where user */
    /*  Route::get('article/user/{id}', 'BlogController@show_article_user'); */
});
/* Create Messenger */
    Route::post('feedback', 'MessengerController@create_messenger')->name('create_messenger');
/* download cv */
Route::get('download/','DownloadController@download')->name('download')->middleware('auth');


Route::get('/login-facebook', 'SocialController@facebookRedirect')->name('login_facebook');
Route::get('/facebook_callback', 'SocialController@loginWithFacebook');

Route::get('/login-google', 'SocialController@googleRedirect')->name('login_google');
Route::get('/google_callback', 'SocialController@loginWithGoogle');


/* maintenance, admin only */
Route::group(['middleware' => 'rule:admin'], function () {
    Route::get('/migrate', 'MaintenanceController@migrate');
    Route::get('/clear-cache', 'MaintenanceController@clear_cache');
});