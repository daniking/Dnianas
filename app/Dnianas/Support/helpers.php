<?php 

function format_date($date) {
    return Carbon::parse($date)->timestamp;
}

function photos_path()
{
    return public_path('photos');
}

function profile_picture($user) 
{
    if($user && $user->profile_picture) {
        return url('/' . 'photos/' . $user->profile_picture);
    } else {
        return url('/photos/profile_picture.jpg');
    }
}
function cover_photo($user)
{
    if($user && $user->cover_photo) {
        return url('/' . 'photos/cover-' . $user->cover_photo);
    }

    return url('/' . 'photos/cover-675f995bcba572f1a5a6b47002a33cba2cef0d8c.jpg');

}