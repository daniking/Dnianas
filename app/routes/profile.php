<?php
/*
 * When they request the user's profile
 * Like: /user/username
 * Or : /user/AkarM13
 */
Route::get('user/{username}', function($username) {
    $user = User::where('username', '=', $username)
    ->with('about', 'posts')
    ->first();

    // $user = $this->getCurrentUserPosts();

    return View::make('profile.user')->withUser($user);
}); 