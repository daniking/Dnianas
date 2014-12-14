<?php 

class About extends Eloquent 
{

    protected $table = 'about';
    
    protected $fillable = ['job_title', 'website', 'about', 'user_id'];

    public function about()
    {
        $this->belongsTo('User');
    }
}