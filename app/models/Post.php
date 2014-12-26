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

    public function likes()
    {
        return $this->belongsToMany('User', 'likes');
    }

    public function isLikedBy(User $user, $post_id)
    {
        $likes = $this->find($post_id)->likes()->where('user_id', $user->id)->first();

        if ($likes) return true;

        return false;
    }
}

