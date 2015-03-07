<?php
namespace Dnianas\User;

use \User;

class UserRepository
{

    /**
     * Returns all of the users in the database
     * @return mixed
     */
    public function getAll()
    {
        return User::all()->toArray();
    }


    /**
     * Returns the user by their id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return User::find($id)->firstOrFail();
    }

    /**
     * Get the user by their username
     * @param  string $username the user's username
     * @return  the user object
     */
    public function getByUsername($username)
    {
        return User::where('username', '=', $username)->first();
    }

    /**
     * Get information about the provided user object
     * @param  \User  $user     The user object 
     * @return object           Collection containing info about the user
     */
    public function getAbout(\User $user)
    {
        return $user->about()->first();
    }

    /**
     * Follow a user
     * @param  integer  $userIdToFollow     The user id that you're trying to follow
     * @param  object   $user               The current user who is performing the follow
     * @return object                 
     */
    public function follow($userIdToFollow, $user)
    {
        User::find($userIdToFollow)->followers()->attach($user->id);

    }

    /**
     * Unfollow a user
     * @param  integer  $userIdToUnfollow   The user id that you're trying to unfollow
     * @param  Object   $user               The current user who is performing the unfollow
     * @return void
     */
    public function unfollow($userIdToUnfollow, $user) 
    {
        User::find($userIdToUnfollow)->followers()->detach($user->id);

    }

    /**
     * Get user posts by their username
     * @param  object   $user
     * @return object   The posts that was submited by the user
     */
    public function getPosts($username)
    {
        $user = User::where('username', $username)->with(['about', 'posts' => function($query)
        {
            $query->latest();
        }])
        ->firstOrFail();

        return $user;
    }

    /**
     * Get feed for the provided user
     * that means, only show the posts from the users that the current user follows.
     *
     * @param User $user                            The user that you're trying get the feed to
     * @return \Illuminate\Database\Query\Builder   The latest posts
     */
    public function getFeed(User $user) 
    {
        $userIds = $user->following()->lists('followed_id');
        $userIds[] = $user->id;
        return \Post::whereIn('user_id', $userIds)->latest()->get();
    }

    /**
     * Determine if the user is followed  by another user
     * @param  User     $user       The follower
     * @param  integer  $user_id    The followed user (The second user)
     * @return boolean              If the user is followed then return true, Otherwise false
     */
    public function isFollowedBy(User $user, $user_id) 
    {   
        // Grab the id from the followers
        $followers = User::find($user_id)->followers()->lists('follower_id');

        // If it was in the array then that means the user is followed by the provided user
        if (in_array($user->id, $followers)) {
            return true;
        }

        // It's not followed by the user, so return false
        return false;
    }

    /**
     * Return the user profile picture path from the server.
     * @return Collection The user profile picture object
     */
    public function profilePicture(User $user)
    {
        return $user->photos()->where('profile_picture', true)->latest()->first();
    }

    /**
     * Return the user cover phoyo path from the server.
     * @return Collection The cover photo picture object
     */
    public function coverPhoto(User $user)
    {
        return $user->photos()->where('cover_photo', true)->latest()->first();
    }
}

