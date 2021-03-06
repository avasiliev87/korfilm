<?php
Route::prefix('admin')->group(function () {
	Auth::routes();
});

// Route::stripeWebhooks('gateway/stripe/webhook');

Route::get('/gateway/vimeo/oauth2_callback', 'Gateway\VimeoController@oauth2_callback');

Route::group(['middleware' => ['auth', 'role:admin']], function(){
	Route::get('admin/dashboard', ['as'=> 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

	Route::get('admin/products', ['as'=> 'admin.products.index', 'uses' => 'Admin\ProductController@index']);

	Route::get('admin/plans', ['as'=> 'admin.plans.index', 'uses' => 'Admin\PlanController@index']);
	Route::put('admin/plans/sync_stripe_plans', ['as'=> 'admin.plans.sync_stripe_plans', 'uses' => 'Admin\PlanController@sync_stripe_plans']);

	Route::get('admin/categories', ['as'=> 'admin.categories.index', 'uses' => 'Admin\CategoryController@index']);
	Route::post('admin/categories', ['as'=> 'admin.categories.store', 'uses' => 'Admin\CategoryController@store']);
	Route::get('admin/categories/create', ['as'=> 'admin.categories.create', 'uses' => 'Admin\CategoryController@create']);
	Route::put('admin/categories/update_videos_count', ['as'=> 'admin.categories.update_videos_count', 'uses' => 'Admin\CategoryController@update_videos_count']);
	Route::put('admin/categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'Admin\CategoryController@update']);
	Route::patch('admin/categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'Admin\CategoryController@update']);
	Route::delete('admin/categories/{categories}', ['as'=> 'admin.categories.destroy', 'uses' => 'Admin\CategoryController@destroy']);
	Route::get('admin/categories/{categories}', ['as'=> 'admin.categories.show', 'uses' => 'Admin\CategoryController@show']);
	Route::get('admin/categories/{categories}/edit', ['as'=> 'admin.categories.edit', 'uses' => 'Admin\CategoryController@edit']);


	Route::get('admin/groups', ['as'=> 'admin.groups.index', 'uses' => 'Admin\GroupController@index']);
	Route::post('admin/groups', ['as'=> 'admin.groups.store', 'uses' => 'Admin\GroupController@store']);
	Route::get('admin/groups/create', ['as'=> 'admin.groups.create', 'uses' => 'Admin\GroupController@create']);
	Route::put('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'Admin\GroupController@update']);
	Route::patch('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'Admin\GroupController@update']);
	Route::delete('admin/groups/{groups}', ['as'=> 'admin.groups.destroy', 'uses' => 'Admin\GroupController@destroy']);
	Route::get('admin/groups/{groups}', ['as'=> 'admin.groups.show', 'uses' => 'Admin\GroupController@show']);
	Route::get('admin/groups/{groups}/edit', ['as'=> 'admin.groups.edit', 'uses' => 'Admin\GroupController@edit']);

	Route::get('admin/slides', ['as'=> 'admin.slides.index', 'uses' => 'Admin\SlideController@index']);
	Route::post('admin/slides', ['as'=> 'admin.slides.store', 'uses' => 'Admin\SlideController@store']);
	Route::get('admin/slides/create', ['as'=> 'admin.slides.create', 'uses' => 'Admin\SlideController@create']);
	Route::put('admin/slides/{slides}', ['as'=> 'admin.slides.update', 'uses' => 'Admin\SlideController@update']);
	Route::patch('admin/slides/{slides}', ['as'=> 'admin.slides.update', 'uses' => 'Admin\SlideController@update']);
	Route::delete('admin/slides/{slides}', ['as'=> 'admin.slides.destroy', 'uses' => 'Admin\SlideController@destroy']);
	Route::get('admin/slides/{slides}', ['as'=> 'admin.slides.show', 'uses' => 'Admin\SlideController@show']);
	Route::get('admin/slides/{slides}/edit', ['as'=> 'admin.slides.edit', 'uses' => 'Admin\SlideController@edit']);

	Route::get('admin/series', ['as'=> 'admin.series.index', 'uses' => 'Admin\SeriesController@index']);
	Route::post('admin/series', ['as'=> 'admin.series.store', 'uses' => 'Admin\SeriesController@store']);
	Route::get('admin/series/create', ['as'=> 'admin.series.create', 'uses' => 'Admin\SeriesController@create']);
	Route::put('admin/series/{series}', ['as'=> 'admin.series.update', 'uses' => 'Admin\SeriesController@update']);
	Route::patch('admin/series/{series}', ['as'=> 'admin.series.update', 'uses' => 'Admin\SeriesController@update']);
	Route::delete('admin/series/{series}', ['as'=> 'admin.series.destroy', 'uses' => 'Admin\SeriesController@destroy']);
	Route::get('admin/series/{series}', ['as'=> 'admin.series.show', 'uses' => 'Admin\SeriesController@show']);
	Route::get('admin/series/{series}/edit', ['as'=> 'admin.series.edit', 'uses' => 'Admin\SeriesController@edit']);


	Route::get('admin/images', ['as'=> 'admin.images.index', 'uses' => 'Admin\ImageController@index']);
	Route::post('admin/images', ['as'=> 'admin.images.store', 'uses' => 'Admin\ImageController@store']);
	Route::get('admin/images/create', ['as'=> 'admin.images.create', 'uses' => 'Admin\ImageController@create']);
	Route::put('admin/images/{images}', ['as'=> 'admin.images.update', 'uses' => 'Admin\ImageController@update']);
	Route::patch('admin/images/{images}', ['as'=> 'admin.images.update', 'uses' => 'Admin\ImageController@update']);
	Route::delete('admin/images/{images}', ['as'=> 'admin.images.destroy', 'uses' => 'Admin\ImageController@destroy']);
	Route::get('admin/images/{images}', ['as'=> 'admin.images.show', 'uses' => 'Admin\ImageController@show']);
	Route::get('admin/images/{images}/edit', ['as'=> 'admin.images.edit', 'uses' => 'Admin\ImageController@edit']);


	Route::get('admin/videos', ['as'=> 'admin.videos.index', 'uses' => 'Admin\VideoController@index']);
	Route::post('admin/videos', ['as'=> 'admin.videos.store', 'uses' => 'Admin\VideoController@store']);
	Route::get('admin/videos/normal', ['as'=> 'admin.videos.normal', 'uses' => 'Admin\VideoController@normal']);
	Route::get('admin/videos/create', ['as'=> 'admin.videos.create', 'uses' => 'Admin\VideoController@create']);
	Route::put('admin/videos/sync_vimeo_videos', ['as'=> 'admin.videos.sync_vimeo_videos', 'uses' => 'Admin\VideoController@sync_vimeo_videos']);
	Route::put('admin/videos/{videos}/publish', ['as'=> 'admin.videos.publish', 'uses' => 'Admin\VideoController@publish']);
	Route::put('admin/videos/{videos}', ['as'=> 'admin.videos.update', 'uses' => 'Admin\VideoController@update']);
	Route::patch('admin/videos/{videos}', ['as'=> 'admin.videos.update', 'uses' => 'Admin\VideoController@update']);
	Route::delete('admin/videos/{videos}', ['as'=> 'admin.videos.destroy', 'uses' => 'Admin\VideoController@destroy']);
	Route::get('admin/videos/{videos}', ['as'=> 'admin.videos.show', 'uses' => 'Admin\VideoController@show']);
	Route::get('admin/videos/{videos}/edit', ['as'=> 'admin.videos.edit', 'uses' => 'Admin\VideoController@edit']);

	Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
		Route::resource('users', 'UserController');
		Route::patch('users/{user}/update_password', 'UserController@update_password')->name('users.update_password');
	});
});

Route::get('verification/verify', 'Auth\VerificationController@verify')->name('verification.verify');


/* IMPORTANT FROM HERE - FOR REACT APP */
Route::get('user/password/reset/{token}', function(){
	return File::get(public_path() . '/client.html');	
})->name('password.reset');

Route::group(['middleware' => ['cacheResponse']], function(){
	Route::get('videos/{slug}', function ($slug) {
		$video = \App\Models\Video::where('slug', $slug)->firstorfail();
		$category = $video->category;

		$og_title = 'KORFILM: ' . $video->name;
		$og_image = $video->featured_image_url;

		$meta_tags = $video->name . ",north korea movie film";

		if($category!=null)
		{
			$meta_tags = $meta_tags . "," . $category->name;
		}

		if(!empty($video->meta_tags))
		{
			$meta_tags = $meta_tags . "," . $video->meta_tags;
		}
		
		$meta_tags = strtolower($meta_tags);
		
		ob_start();
		include public_path() . '/client.html';
		$var = ob_get_contents();
		ob_end_clean();
		
		return $var;
	});

	Route::get('user/videos/{slug}', function ($slug) {
		$video = \App\Models\Video::where('slug', $slug)->firstorfail();

		$og_title = 'KORFILM: ' . $video->name;
		$og_image = $video->featured_image_url;
		$meta_tags = $video->name . ",north korea movie film," . $video->meta_tags;
		$meta_tags = strtolower($meta_tags);
		ob_start();
		include public_path() . '/client.html';
		$var = ob_get_contents();
		ob_end_clean();
		
		return $var;
	});

	Route::get('categories/{slug}', function ($slug) {
		$category = \App\Models\Category::where('slug', $slug)->firstorfail();
		
		$og_title = 'KORFILM: ' . $category->name;
		$og_image = "https://korfilm.co/images/og-image.jpg";
		$meta_tags = $category->name . ",north korea," . $category->meta_tags;
		$meta_tags = strtolower($meta_tags);

		ob_start();
		include public_path() . '/client.html';
		$var = ob_get_contents();
		ob_end_clean();
		
		return $var;
	});

	Route::any('{all}', function () {
		$og_title = "KORFILM";
		$og_image = "https://korfilm.co/images/og-image.jpg";
		$meta_tags = "korfilm, feature film, tv series, animation, festival, north korea";

		ob_start();
		include public_path() . '/client.html';
		$var = ob_get_contents();
		ob_end_clean();
		
		return $var;
	})->where('all', '.*');
});