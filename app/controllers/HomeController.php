<?php 

use Dnianas\Post\PostRepository;

use Dnianas\User\UserRepository;

use Dnianas\Notification\NotificationRepository;

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

    /**
     * The notifications repository
     *  @var Dnianas\Notification\NotificationRepository
     */
    protected $notification;

    protected $profilePicture;

    public function __construct(UserRepository $userRepo, PostRepository $postRepo, 
        NotificationRepository $notificationRepo)
    {
        $this->user = $userRepo;
        $this->post = $postRepo;
        $this->notification = $notificationRepo;
    }

    public function index()
    {
        // If the user is logged in then show the homepage
        if (Auth::check()) {
            $posts = $this->user->getFeed(Auth::user());
            $about = $this->user->getAbout(Auth::user());
            $notifications = $this->notification->latest(Auth::user());

            // Get only the notification count for those are new.
            $notificationCount = $notifications->filter(function($notification) 
            {
                if($notification->seen == 0) {
                    return true;
                }
            });

            return View::make("home.index", compact('posts', 'about', 'notifications', 'notificationCount'));
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
        $notifications = $this->notification->latest(Auth::user());

        // Get only the notification count for those are new.
        $notificationCount = $notifications->filter(function($notification) 
        {
            if($notification->seen == 0) {
                return true;
            }
        });

        return View::make('profile.index')->with(compact('user', 'notifications', 'notificationCount'));
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
            $this->notification->send($user->id, $profile_id, $profile_id, 'User', 'Follow');

            return Response::json([
                'follow' => 'true'
            ]);
        }

        // Otherwise, Unfollow the user
        $this->user->unfollow($profile_id, $user);

        // Delete the notification
         $this->notification->delete($user->id, $profile_id, $profile_id, 'User', 'Follow');

        return Response::json([
            'unfollow' => 'true'
        ]);
    }

}