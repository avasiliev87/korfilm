<?php

use Illuminate\Http\Request;

Route::post('user/login', 'UserController@login');
Route::post('user/register', 'UserController@register');
Route::post('user/password/email', 'Auth\ForgotPasswordController@send_reset_link_email');
Route::post('user/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth:api']], function(){
	Route::get('user', 'UserController@index');
	Route::post('user/verification/resend', 'Auth\VerificationController@resend');
});

Route::group(['middleware' => ['auth:api', 'verified']], function(){
	Route::get('user/subscriptions', 'UserController@subscriptions');
	Route::get('user/invoices', 'UserController@invoices');
	Route::post('plans/{plan_id}/subscribe', ['as'=>'plans.subscribe', 'uses' => 'PlanController@subscribe']);
	Route::delete('plans/{plan_id}/cancel', ['as'=>'plans.cancel', 'uses' => 'PlanController@cancel']);

	// user routes
	Route::post('user/update_password', 'UserController@update_password');
	Route::get('user/videos', 'VideoController@index');
	Route::post('user/videos/{id_or_slug}/like', 'VideoController@like');
	Route::delete('user/videos/{id_or_slug}/unlike', 'VideoController@unlike');
	Route::post('user/videos/{id_or_slug}/add_history', 'VideoController@add_history');

	Route::get('user/categories', 'CategoryController@index');
	Route::get('user/videos/{id_or_slug}', 'VideoController@show');
	Route::get('user/categories/{id_or_slug}', 'CategoryController@show');
	Route::get('user/categories/{id_or_slug}/videos', 'CategoryController@videos');
	Route::get('user/tags', 'TagController@index');
	Route::get('user/products', 'ProductController@index');

	Route::get('user/favorite_videos', 'UserController@favorite_videos')->middleware('doNotCacheResponse');
	Route::get('user/histories', 'UserController@histories')->middleware('doNotCacheResponse');

	// pro routes
	Route::get('pro/videos', 'VideoController@index');
	Route::post('pro/videos/{id_or_slug}/like', 'VideoController@like');
	Route::delete('pro/videos/{id_or_slug}/unlike', 'VideoController@unlike');

	Route::get('pro/categories', 'CategoryController@index');
	Route::get('pro/images', 'ImageController@index');
	Route::get('pro/series', 'SeriesController@index');
	Route::get('pro/series/{id_or_slug}', 'SeriesController@show');
	Route::get('pro/videos/{id_or_slug}', 'VideoController@show');
	Route::get('pro/categories/{id_or_slug}', 'CategoryController@show');
	Route::get('pro/categories/{id_or_slug}/videos', 'CategoryController@videos');
	Route::get('pro/tags', 'TagController@index');
	Route::get('pro/products', 'ProductController@index');
	Route::get('pro/favorite_videos', 'UserController@favorite_videos');
});

Route::group(['middleware' => ['doNotCacheResponse', 'auth:api', 'role:admin']], function(){
	// admin routes
	Route::post('categories/{category_id}/add_video', ['as'=> 'admin.categories.add_video', 'uses' => 'CategoryController@add_video']);
	Route::delete('categories/{category_id}/remove_video', ['as'=> 'admin.categories.remove_video', 'uses' => 'CategoryController@remove_video']);

	Route::get('videos/featured', ['as'=> 'admin.videos.featured', 'uses' => 'VideoController@featured']);
	Route::get('videos/normal', ['as'=> 'admin.videos.normal', 'uses' => 'VideoController@normal']);

	Route::post('videos/{video_id}/add_category', ['as'=> 'admin.videos.add_category', 'uses' => 'VideoController@add_category']);
	Route::delete('videos/{video_id}/remove_category', ['as'=> 'admin.videos.remove_category', 'uses' => 'VideoController@remove_category']);

	Route::post('videos/{video_id}/add_group', ['as'=> 'admin.videos.add_group', 'uses' => 'VideoController@add_group']);
	Route::delete('videos/{video_id}/remove_group', ['as'=> 'admin.videos.remove_group', 'uses' => 'VideoController@remove_group']);

	Route::post('videos/{video_id}/add_tag', ['as'=> 'admin.videos.add_tag', 'uses' => 'VideoController@add_tag']);
	Route::delete('videos/{video_id}/remove_tag', ['as'=> 'admin.videos.remove_tag', 'uses' => 'VideoController@remove_tag']);

	Route::post('slides/{slide_id}/add_tag', ['as'=> 'admin.slides.add_tag', 'uses' => 'SlideController@add_tag']);
	Route::delete('slides/{slide_id}/remove_tag', ['as'=> 'admin.slides.remove_tag', 'uses' => 'SlideController@remove_tag']);
});

Route::get('slides', 'SlideController@index');
Route::get('videos', 'VideoController@index');
Route::get('categories', 'CategoryController@index');
Route::get('images', 'ImageController@index');
Route::get('series', 'SeriesController@index');
Route::get('series/{id_or_slug}', 'SeriesController@show');
Route::get('videos/{id_or_slug}', 'VideoController@show');
Route::get('categories/{id_or_slug}', 'CategoryController@show');
Route::get('categories/{id_or_slug}/videos', 'CategoryController@videos');
Route::get('tags', 'TagController@index');
Route::get('products', 'ProductController@index');