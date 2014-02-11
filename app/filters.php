<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});
*/

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

*/
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});
*/

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


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

Route::filter('exec', function()
{
	if (!Auth::User()->admin && !Auth::User()->is_currently_part_of_exec()) return Redirect::to('rms/account/login')->with('warning','You are not permitted access. Please login as an admin');
});

Route::filter('admin', function()
{
	if (!Auth::User()->admin) return Redirect::to('rms/account/login')->with('warning','You are not permitted access. Please login as an admin');
});

Route::filter('manage_team', function()
{
	$team_id = Request::route()->parameters[1];
	if (!Auth::User()->can_manage_team($team_id)) return Redirect::to('rms/account/login')->with('warning','You are not a admin');
});