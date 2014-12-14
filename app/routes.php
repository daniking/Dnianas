<?php

App::bind('Dnianas\Repositories\Post\PostRepositoryInterface', function()
{
   return new Dnianas\Repositories\Post\PostRepository;
});

App::bind('Dnianas\Repositories\User\UserRepositoryInterface', function()
{
   return new Dnianas\Repositories\User\UserRepository;
});


/**
 * Apply a CSRF (Cross-site Request Frogery) filter to every post requests
 */
Route::when('*', 'csrf', ['post']);
Route::get('/', 'HomeController@index');


// Only authinticated users should see the homepage.
Route::get('home', ['as' => 'home_path', 'before' => 'auth', function () 
{
    return View::make('home.index');
}]);

/*
 *  Login route 
 */
Route::post('login', [
    'uses'  => 'AuthController@postLogin'
]);

/*
 * Register route
 */
Route::post('register', [
    'uses'  => 'AuthController@postRegister'
]);

/*
 * Logout route
 */
Route::get('logout', [
    'as' => 'logout', 
    'uses' => 'AuthController@logout', 
    'before' => 'auth'
]);

/*
 * Getting Started route [GET]
 */
Route::get('getting_started', [
    'as'        => 'getting_started_route',
    'uses'      => 'AuthController@getGettingStarted',
    'before'    => 'auth'
]);

/*
 * Getting Started route [POST]
 */
Route::post('getting_started', [
    'uses'      => 'AuthController@postGettingStarted',
    'before'    => 'auth'
]);

/*
 * When they request this link, Their account should be activated
 */
Route::get('/activate/{code}', 'AuthController@activate');

/*
 * When they try to create posts 
 */
Route::post('posts/create', 'PostController@create');

/*
* When the short polling wants new posts
 */
Route::get('/posts/get/{last_id}', 'PostController@get');


/*
 * When they request the user's profile
 * Like: /user/username
 * Or : /user/AkarM13
 */
Route::get('user/{username}', function($username) {
    $user = User::where('username', '=', $username)
    ->with('about')
    ->first();

    return View::make('profile.user')->withUser($user);
}); 