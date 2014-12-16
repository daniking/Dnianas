<?php 
namespace Dnianas\Post;

use \Post;

class PostRepository implements PostRepositoryInterface
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
        return Post::with('user', 'comments')->latest()->get();
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
}
