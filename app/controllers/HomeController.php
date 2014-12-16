<?php 

use Dnianas\Post\PostRepositoryInterface;

use Dnianas\User\UserRepositoryInterface;

class HomeController extends BaseController
{
    protected $post;

    protected $user;

    public function __construct(UserRepositoryInterface $userRepo, PostRepositoryInterface $postRepo)
    {
        $this->user = $userRepo;
        $this->post = $postRepo;
    }

    public function index()
    {
        // If the user is logged in then show the homepage
        if (Auth::check()) {
            $posts = $this->post->getLatest();
            $user  = $this->user->getById(Auth::id());
            $about = $this->user->getAbout($user);


            return View::make("home.index", compact('posts', 'about'));
        }


        // Otherwise, show the login/registeration page
        return View::make('auth.home');

    }


}