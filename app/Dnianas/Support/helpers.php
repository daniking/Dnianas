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
    if($user && !is_null($user->profile_picture)) {
        return url('/' . 'photos/' . $user->profile_picture);
    }
    
    return url('/photos/profile_picture.jpg');

}
function cover_photo($user)
{
    if(!is_null($user->cover_photo)) {
        return url('/' . 'photos/cover-' . $user->cover_photo);
    }

}