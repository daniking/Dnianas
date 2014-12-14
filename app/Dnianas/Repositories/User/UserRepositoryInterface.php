<?php
namespace Dnianas\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * Returns all of the users in the database
     * @return mixed
     */
    public function getAll();

    /**
     * Returns the user by their id
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Get the user by their username
     * @param  string $username the user's username
     * @return  the user object
     */
    public function getByUsername($username);

    /** 
     * Get info about the user
     * @param  User   $user 
     * @return mixed
     */
    public function getAbout(\User $user);
}