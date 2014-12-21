<?php 

use Laracasts\Validation\FormValidationException;

use Dnianas\Post\PostCreationService;
use Dnianas\Post\PostRepository;

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

    /**
     * @param PostForm $postForm
     * @param PostCreationService $post
     * @param PostRepository $postRepo
     */
    public function __construct(PostForm $postForm, PostCreationService $post, PostRepository $postRepo)
    {  
        $this->posts = $postRepo;
        $this->postForm = $postForm;
        $this->post = $post;
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

        // Return a message along with the html content form the
        return Response::json([
            'success' => 'true',
            'message' => 'Your post has been successfuly posted!',
            'post_html' => $html
        ]);

    }


    /**
     * @param $last_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest($last_id)
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