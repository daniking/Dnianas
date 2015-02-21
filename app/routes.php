<?php


// Route::get('test', function() {
//     $image = Image::make(file_get_contents('http://www.lapatilla.com/site/wp-content/uploads/2014/11/Eminem2.jpg'));

//     // resize the image to a width of 300 and constrain aspect ratio (auto height)
//     $image->resize(160, null, function ($constraint) {
//         $constraint->aspectRatio();
//     });

//     return $image->response('jpg');
// });

Route::get('test', function() {
    return View::make('test.upload');
});

Route::post('test/upload', function() {
    $input = Input::all();

    $rules = ['profile_picture' => 'required|min:10|image|real_image|'];

    $validator = Validator::make([
        'profile_picture' =>  $input['profile_picture']
    ]
    , $rules);

    if ($validator->fails()) {
        return 'It\'s not an image!';
    } 

    $extension = $input['profile_picture']->getClientOriginalExtension();
    $file_name = $input['profile_picture']->getClientOriginalName();

    $image = Image::make($input['profile_picture']);
    $name = sha1(time() . $file_name);

    // Sample: domain.com/photos/4952058f4d990c21019c7bc6a319bddcba6cbfa9.png
    $destination = photos_path() . '/' . $name . '.' . $extension;
    
    $image->fit(300, 300);

    $image->save($destination);

    return Redirect::back()->with('message', 'Your profile picture has been successfully set!');
});

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
 * Gettin gStarted route [GET]
 */
Route::get('getting_started', [
    'as'        => 'getting_started_route',
    'uses'      => 'AuthController@getGettingStarted',
    'before'    => 'auth'
    ]);

Route::get('getting_started/step_two', function () {
    return View::make('auth.step_two');
});

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
Route::get('@{username}', ['as' => 'profile.show', 'uses' => 'HomeController@getProfile']);

/**
 * When a user tries to like a post
 */
Route::post('posts/like', 'PostController@like');

/** 
 * When a user tries to follow another user
 */
Route::post('follow', ['as' => 'follow_path', 'uses' => 'HomeController@follow']);

