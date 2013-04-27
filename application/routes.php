<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

//RMS Routes

Route::controller('rms.account');
Route::controller('rms.teams');
Route::controller('rms.years');
Route::controller('rms.executives');
Route::get('rms/users/search(:any)', 'rms.users@search');
Route::controller('rms.users');

Route::controller('rms.faqs');
Route::controller('rms.sponsors');
Route::controller('rms.news');
Route::controller('rms.camp.settings');
Route::controller('rms.camp.registrations');

//Front End Routes
Route::controller('home');


Route::get('/rms', function()
{
	return Redirect::to('rms/account');
});

Route::get('/', function()
{
	return Redirect::to('home');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		// Save the attempted URL
		Session::put('pre_login_url', URL::current());

		return Redirect::to('rms/account/login')->with('warning','You must login in to access this area of the site');
	}
});

Route::filter('admin', function()
{
	if (!Auth::User()->admin) return Redirect::to('rms/account/login')->with('warning','You are not permitted access. Please login as an admin');
});

Route::filter('manage_team', function()
{
	$team_id = Request::route()->parameters[1];
	$year = Year::current_year();
	if (!Auth::User()->can_manage_team($year->id,$team_id)) return Redirect::to('rms/account/login')->with('warning','You are not a admin');
});

