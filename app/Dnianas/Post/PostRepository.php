<?php 
namespace Dnianas\Post;

use \Post;
use User;

class PostRepository
{
    /**
     * Find a post by it's id
     * @param  integer $id
     * @return array 
     */
    public function findById($id)
    {
        return Post::find($id)->get();
    }

    /**
     * Get the latest posts from the database
     * @return mixed
     */
    public function getLatest()
    {
        return Post::with('comments.user')->latest()->get();
    }

    /**
     * Get post that's greater than the specified id
     * @param  integer $id 
     * @return mixed    
     */
    public function greaterThan($id)
    {
        return Post::with('user')->where('id', '>', $id)->get();
    }

    public function like($post_id, User $user)
    {
        return Post::find($post_id)->likes()->attach($user->id);
    }

    public function unlike($post_id, User $user)
    {
        return Post::find($post_id)->likes()->detach($user->id);
    }

    public function isLikedBy(User $user, $post_id) 
    {
        $likes = Post::find($post_id)->likes()->where('user_id', $user->id)->first();

        // If the user likes that post
        if ($likes) return true;

        return false;
    }


}
