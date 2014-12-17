<?php
/*
 * When they try to create posts 
 */
Route::post('posts/create', 'PostController@create');

/*
* When the short polling wants new posts
 */
Route::get('/posts/latest/{last_id}', 'PostController@latest');

