<?php
/**
 * Apply a CSRF (Cross-site Request Frogery) filter to every post requests
 */
Route::when('*', 'csrf', ['post']);

/* 
 *  Show home page if the user is logged in
 *  Otherwise show the login/registration form
 */
Route::get('/', 'HomeController@index');

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
Route::get('posts/latest/{last_id}', 'PostController@latest');


/**
 * When the user inserts a comment
 */
Route::post('comment/create', 'CommentController@create');

/*
 * When they request the user's profile
 * Like: /@username
 * Or : /@AkarM13
 */
Route::post('posts/like', 'PostController@like');


Route::get('@{username}', ['as' => 'profile.show', 'uses' => 'HomeController@getProfile']);
Route::post('follow', ['as' => 'follow_path', 'uses' => 'HomeController@follow']);