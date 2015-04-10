<?php 

use Dnianas\Post\PostRepository;

use Dnianas\User\UserRepository;

class HomeController extends BaseController
{
    /**
     * The post repository 
     * @var Dnianas\Post\PostRepositoryInterface
     */
    protected $post;

    /**
     * The users repository
     * @var Dnianas\User\UserRepositoryInterface
     */
    protected $user;

    protected $profilePicture;

    public function __construct(UserRepository $userRepo, PostRepository $postRepo)
    {
        $this->user = $userRepo;
        $this->post = $postRepo;
    }

    public function index()
    {
        // If the user is logged in then show the homepage
        if (Auth::check()) {
            $posts = $this->user->getFeed(Auth::user());
            $about = $this->user->getAbout(Auth::user());
        
            return View::make("home.index", compact('posts', 'about'));
        }

        // Otherwise, show the login/registeration page
        return View::make('auth.home');

    }

    /** 
     * When they request user's profile
     * example.com/@username
    */
    public function getProfile($username)
    {  
        // Get the information about the user along with their post
        $user = $this->user->getPosts($username);
        return View::make('profile.index')->with(compact('user'));
    }

    /**
     * Follow a user by their id
     */
    public function follow()
    {
        // Get the user profile id that you're trying to follow
        $profile_id = Input::get('profile_id');

        // Get the currently authinticated user
        $user = Auth::user();

        // If the user isn't already followed
        if(!$this->user->isFollowedBy($user, $profile_id)) {
            $this->user->follow($profile_id, $user);

            // Inform the user about the action.
            Notification::firstOrCreate([
                'sender_id' => $user->id,
                'object_id' => $profile_id,
                'object_type' => 'User',
                'notification_type' => 'Follow',
                'seen' => 0,
            ]);

            return Response::json([
                'follow' => 'true'
            ]);
        }

        // Otherwise, Unfollow the user
        $this->user->unfollow($profile_id, $user);

        return Response::json([
            'unfollow' => 'true'
        ]);
    }

}