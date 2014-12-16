<?php 

class Post extends Eloquent 
{

    public static $rules = ['post_content' => 'required'];

    protected $fillable = ['post_content', 'posted_date'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';


    public function user()
    {
        return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}

