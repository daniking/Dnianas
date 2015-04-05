<?php 

class Notification extends Eloquent
{   

    // The user that does the activity
    public function user()
    {
        return $this->belongsTo('User');
    }

    // The reciever of that notification
    public function recipient()
    {
        return $this->belongsTo('User', 'recipient_id');
    }

}