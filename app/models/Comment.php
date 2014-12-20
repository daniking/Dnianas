<?php 

class Comment extends Eloquent 
{

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Returns the commenter's full name
     * @return mixed
     */
    public function fullName()
    {
        return $this->user->first_name . ' ' . $this->user->last_name;
    }
}