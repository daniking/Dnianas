<?php 
namespace Dnianas\Post;

interface PostRepositoryInterface
{

    /**
     * Get post by their id
     * @param  integer
     * @return mixed
     */
    public function findById($id);

    /**
     * Get latest posts
     * @return array the posts
     */
    public function getLatest();



    /**
     * Get post that's greater than the specified id
     * @param  integer $id 
     * @return mixed    
     */
    public function greaterThan($id);

}