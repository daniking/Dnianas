<?php
use Laracasts\Validation\FormValidationException;
use Dnianas\User\UserRepository;
use Dnianas\Post\PostCreationService;
use Dnianas\Post\PostRepository;
use Dnianas\Notification\NotificationRepository;
use Dnianas\Forms\PostForm;

class PostController extends BaseController
{

    /*
     * Dnianas\Services\PostCreationService
     */
    protected $post;

    /*
    * The post repository
     */
    protected $posts;

    protected $user;

    protected $notification;

    /**
     * @param UserRepository $user
     * @param PostForm $postForm
     * @param PostCreationService $post
     * @param PostRepository $postRepo
     */
    public function __construct(UserRepository $user, PostForm $postForm, PostCreationService $post, PostRepository $postRepo,
            NotificationRepository $notificationRepo)
    {
        $this->posts = $postRepo;
        $this->postForm = $postForm;
        $this->post = $post;
        $this->user = $user;
        $this->notification = $notificationRepo;
    }

    public function index()
    {
        $this->beforeFilter('auth');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        // Get the input
        $input = Input::all();

        // Validate it
        try {
            $this->postForm->validate($input);
        } catch(FormValidationException $e) {
            return Response::json([
                'success' => 'false',
                'message' => 'You didn\'t enter anything, Post cannot be empty.'
            ]);
        }

        // Insert it to the database
        $post = $this->post->create($input, Auth::user()->id);

        // Get the html content from the view
        $html = View::make('posts.post', ['post_id' => $post->id])->render();

        // Return a message along with the html content form the view
        return Response::json([
            'success' => 'true',
            'message' => 'Your post has been successfully posted!',
            'post_html' => $html
        ]);

    }


    /**
     * @param $last_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest($last_id)
    {
        $posts = $this->posts->greaterThan($last_id, Auth::user());

        $html = View::make('posts.newPostArrived', ['posts' => $posts])->render();

        // If there are any new posts
        if ($posts->count()) {
            return Response::json([
                'is_new' => 'true',
                'html' => $html
            ]);
        }

        return Response::json([
            'is_new' => 'false'
        ]);
    }

    /**
     * Like a specific post using post data
     */
    public function like()
    {
        // Grab the post id from the input
        $post_id    = Input::get('post_id');
        $like_count = Input::get('like_count');

        // Get the currently authinticated user
        $user    = Auth::user();

        if (!$this->posts->isLikedBy($user, $post_id)) {
            // Like the post 
            $this->posts->like($post_id, Auth::user());

            // Send the notification
            $this->notification->send($user->id, Input::get('user_id'), $post_id, 'Post', 'Like');

            return Response::json([
                'like'      => 'true',
                'like_count' => $like_count == 0 ? $like_count += 1 : $like_count++,
            ]);
        }
        
        // Otherwise, Unlike the post
        $this->posts->unlike($post_id, Auth::user());

        // Delete the notification
        $this->notification->delete($user->id, Input::get('user_id'), $post_id, 'Post', 'Like');

        return Response::json([
            'unlike'     => 'true',
            'like_count' => max(+$like_count - 1, 0),
        ]);
    }

}