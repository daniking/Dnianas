<?php 
namespace Dnianas\Post;

use Post;
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
     * @param User $user
     * @return mixed
     */
    public function greaterThan($id, User $user)
    {
        // return Post::with('user')->where('id', '>', $id)->get();
        $userIds = $user->following()->lists('followed_id');
        $userIds[] = $user->id;
        return Post::whereIn('user_id', $userIds)->where('id', '>', $id);
    }

    /**
     * Like post by it's id
     * @param  integer      $post_id    The post id
     * @param  User       $user       The user that is trying to like the post
     * @return int
     */
    public function like($post_id, User $user)
    {
        return Post::find($post_id)->likes()->attach($user->id);
    }

    /**
     * Unlike post by it's id
     * @param  integer $post_id The post id
     * @param  User $user The user that is trying to unlike the post
     * @return int
     */
    public function unlike($post_id, User $user)
    {
        return Post::find($post_id)->likes()->detach($user->id);
    }

    /**
     * Determine if the post is liked by a user
     * @param  User     $user       The current authenticated user
     * @param  integer  $post_id    The post id that you're trying to check against
     * @return boolean              Return true if found, false if not.
     */
    public function isLikedBy(User $user, $post_id) 
    {   
        
        $likes = Post::find($post_id)->likes()->where('user_id', $user->id)->first();

        // If the user likes that post
        if ($likes) return true;
        
        return false;
    }


}
