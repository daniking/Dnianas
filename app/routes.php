<?php
/**
 * Apply a CSRF (Cross-site Request Frogery) filter to every post requests
 */
Route::when('*', 'csrf', ['post']);

/* 
 *  Show home page if the user is logged in
 *  Otherwise show the login/registeration form 
 */
Route::get('/', 'HomeController@index');

/*
 * Require all the files inside of 'routes' directory
 */
foreach (File::allFiles(__DIR__.'/routes') as $partial) 
{
    require($partial->getPathname());
}

