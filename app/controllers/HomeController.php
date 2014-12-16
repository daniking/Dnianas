<?php 

use Dnianas\Post\PostRepository;

use Dnianas\User\UserRepository;

class HomeController extends BaseController
{
    /**
     * The posts repository 
     * @var Dnianas\Post\PostRepositoryInterface
     */
    protected $posts;

    /**
     * The users repository
     * @var Dnianas\User\UserRepositoryInterface
     */
    protected $users;


    public function __construct(UserRepository $userRepo, PostRepository $postRepo)
    {
        $this->users = $userRepo;
        $this->posts = $postRepo;
    }

    public function index()
    {
        // If the user is logged in then show the homepage
        if (Auth::check()) {
            $posts = $this->posts->getLatest();
            $user  = $this->users->getById(Auth::id());
            $about = $this->users->getAbout($user);

            return View::make("home.index", compact('posts', 'about'));
        }

        // Otherwise, show the login/registeration page
        return View::make('auth.home');

    }


}