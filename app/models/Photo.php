<?php 

class Photo extends Eloquent 
{
    protected $fillable = ['path', 'photoable_id', 'photoable_type', 'profile_picture', 'cover_photo'];

    public function photoable()
    {
        return $this->morphTo();
    }
    /**
     * Get the user profile picture path
     * @return object The path to the user profile picture
     */
    public function profilePicture()
    {
        return ($this->profile_picture == true) ? ($this->path) : '';
    }

     /**
     * Get the user cover photo path
     * @return object The path to the user cover photo
     */
    public function coverPhoto()
    {
        return ($this->cover_photo == true) ? ($this->path) : '';
    }

}