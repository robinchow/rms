<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/


// RMS Routes

Route::get('rms', function() {return Redirect::to('rms/account');});

Route::get('allteams', function() {
    return View::make('allteams.index');
});
Route::get('revuemail', function() {
    return View::make('revuemail.index');
});

Route::controller('rms/account', 'AccountsController');
Route::controller('rms/teams', 'TeamsController');
Route::controller('rms/executives', 'ExecutivesController');
Route::controller('rms/exec', 'ExecutivesController');
Route::controller('rms/years', 'YearsController');
Route::controller('rms/users', 'UsersController');
Route::controller('rms/news', 'NewsController');
Route::controller('rms/blog/posts', 'BlogPostsController');
Route::controller('rms/blog', 'BlogPostsController');
Route::controller('rms/faqs', 'FaqsController');
Route::controller('rms/sponsors', 'SponsorsController');

Route::controller('rms/camp/settings', 'CampSettingsController');
Route::controller('rms/camp/registrations', 'CampRegistrationsController');

Route::controller('rms/merch/items', 'MerchItemsController');
Route::controller('rms/merch/orders', 'MerchOrdersController');

Route::controller('rms/wellbeing/nights', 'WellbeingNightsController');
Route::controller('rms/wellbeing/orders', 'WellbeingOrdersController');
Route::controller('rms/wellbeing/bundles', 'WellbeingBundlesController');


// Public Routes

Route::controller('home', 'HomeController');
Route::controller('/', 'HomeController');

/*
Route::controller('rms.years');
Route::controller('rms.executives');
Route::get('rms/users/search(:any)', 'rms.users@search');
Route::controller('rms.users');

Route::controller('rms.faqs');
Route::controller('rms.sponsors');
Route::controller('rms.news');
Route::controller('rms.camp.settings');
Route::controller('rms.camp.registrations');

Route::controller('rms.merch.items');
Route::controller('rms.merch.orders');

Route::controller('rms.wellbeing.orders');
Route::controller('rms.wellbeing.nights');


Route::controller('rms.blog.posts');
*/
//Front End Routes



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
