<?php 
namespace Dnianas\Post;

class PostCreationService 
{

    /**
     * @param $input
     * @param $user_id
     * @return \Post
     */
    public function create($input, $user_id)
    {
        // Validation passed to we insert it to our database
        $post = new \Post;
        $post->post_content = $input['post_content'];
        $post->posted_date  = \Carbon::now();
        $post->user_id      = $user_id;
        $post->save();

        return $post;


    }
}