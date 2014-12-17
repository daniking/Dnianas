<?php
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
