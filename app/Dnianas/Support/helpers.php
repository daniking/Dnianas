<?php 

function format_date($date) {
    return Carbon::parse($date)->timestamp;
}

function photos_path()
{
    return public_path('photos');
}

function profile_picture($imageName) 
{
    return url('/' . 'photos/' . $imageName);
}
function cover_photo($imageName)
{
    return url('/' . 'photos/' . 'cover-' . $imageName);
}