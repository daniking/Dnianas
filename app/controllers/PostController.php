<?php 

use Laracasts\Validation\FormValidationException;

use Dnianas\Services\PostCreationService;

use Dnianas\Forms\PostForm;

use Dnianas\Repositories\Post\PostRepositoryInterface;

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

    public function __construct(PostForm $postForm, PostCreationService $post, PostRepositoryInterface $postRepo)
    {  
        $this->posts = $postRepo;
        $this->postForm = $postForm;
        $this->post = $post;
    }

    public function index()
    {
        $this->beforeFilter('auth');
    }

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
                'message' => 'You didn\'t entered anything, Post cannot be empty.'
            ]);       
        }

        // Insert it to the database
        $post = $this->post->create($input, Auth::user()->id);

        // Get the html content from the view
        $html = View::make('posts.post', ['post_id' => $post->id])->render();

        // Return a message along with the html content form the
        return Response::json([
            'success' => 'true',
            'message' => 'Your post has been successfuly posted!',
            'post_html' => $html
        ]);

    }

    public function get($last_id) 
    {
        $posts = $this->posts->greaterThan($last_id);

        $html = View::make('home.new_post', ['posts' => $posts])->render();

        // If there is any new posts
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

}