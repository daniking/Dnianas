<?php 

class Photo extends Eloquent 
{
    protected $fillable = ['path', 'photoable_id', 'photoable_type', 'profile_picture', 'cover_photo'];

    public function photoable()
    {
        return $this->morphTo();
    }


}