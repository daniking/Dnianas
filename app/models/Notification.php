<?php 

class Notification extends Eloquent
{   
    protected $fillable = [
        'sender_id', 
        'recipient_id', 
        'object_id', 
        'object_type', 
        'notification_type', 
        'link', 
        'seen'
    ];

    public $timestamps = true;
    // The user that does the activity
    public function sender()
    {
        return $this->belongsTo('User', 'sender_id');
    }

    // The reciever of that notification
    public function recipient()
    {
        return $this->belongsTo('User', 'recipient_id');
    }

}