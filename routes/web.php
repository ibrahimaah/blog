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

Route::get('/', 'PagesController@getHome');
Route::get('home', 'PagesController@getHome')->name('home');
Route::get('pages/about', 'PagesController@getAbout')->name('about');
Route::get('pages/contact', 'PagesController@getContact')->name('contact');
Route::get('pages/{category_id}', 'PagesController@getPostsByCategory')->name('postsByCat');

Route::resource('posts','PostController')->middleware('auth')->middleware('can:do-every-thing');
//u can add constraints to your routes using regular expressions and Where statement
Route::get('blog/single/{slug}','BlogController@getSingle')->where('slug','[\w\d\-\_]+')->name('blog.single');
 
/*
 It is preferable to use Delete request in order to prevent any user from
 accessing destroy url therefor deleting important data
*/

Route::get('posts/{post_id}/destroy','PostController@destroy')->name('delete_post')->middleware('can:do-every-thing');


Route::get('tags/{tag_id}/destroy','TagController@destroy')->name('delete_tag')->middleware('can:do-every-thing');
//applying gate to middleware
Route::resource('users','UserController')->middleware('can:do-every-thing');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories','CategoryController',['except'=>'create'])->middleware('can:do-every-thing');
Route::resource('tags','TagController',['except'=>'create'])->middleware('can:do-every-thing');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//Manage User Comments on posts
Route::post('blog/{post_id}/store','BlogController@add_comment')->name('add_comment');
Route::get('blog/{comment_id}/edit','BlogController@edit')->name('edit_comment');
Route::put('blog/{comment_id}/update','BlogController@update')->name('update_comment');
Route::delete('blog/{comment_id}/destroy','BlogController@destroy')->name('delete_comment');
//Manage Comments from Dashboard
Route::get('comments','CommentController@index')->name('comments.index');
Route::delete('comments/{comment_id}','CommentController@destroy')->name('admin_delete_comment');
Route::get('blog/{slug}#{comment_id}','BlogController@destroy')->name('show_comment');
//Get posts that belongs to specific tag
Route::get('blog/tag/{tag_name}','BlogTagController@get_by_tag')->name('get_by_tag');
//Get Search Results
Route::get('blog/search','SearchController@get_search_res')->name('get_search_res');
//Facebook Login Api
Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback'); 
//Like and dislike post
Route::get('blog/like/{post_id}','BlogController@ajax_like')->name('ajax_like');

