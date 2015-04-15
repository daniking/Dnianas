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
 * Getting started route [GET]
 */
Route::get('getting_started', [
    'as'        => 'getting_started_route',
    'uses'      => 'GettingStartedController@getGettingStarted',
    'before'    => 'auth'
    ]);

Route::get('getting_started/step_two', function () {
    return View::make('auth.step_two');
});

/*
 * Getting Started route [POST]
 */
Route::post('getting_started', [
    'uses'      => 'GettingStartedController@postGettingStarted',
    'before'    => 'auth'
    ]);


Route::post('getting_started/step_two/profile_picture', [
    'uses' => 'GettingStartedController@setProfilePicture', 
    'before' => 'auth'
]);

Route::post('getting_started/step_two/cover_photo', [
    'uses' => 'GettingStartedController@setCoverPhoto', 
    'before' => 'auth'
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
Route::get('@{username}', [
    'as' => 'profile.show', 
    'uses' => 'HomeController@getProfile',
    'before' => 'auth']);

/**
 * When a user tries to like a post
 */
Route::post('posts/like', 'PostController@like')->before('auth');

/** 
 * When a user tries to follow another user
 */
Route::post('follow', ['as' => 'follow_path', 'uses' => 'HomeController@follow']);


Route::post('/notifications/read', 'NotificationController@read');