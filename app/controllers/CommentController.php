<?php
use Dnianas\User\UserRepository;
use Dnianas\Comment\CommentCreationService;
use Dnianas\Forms\CommentForm;
use Laracasts\Validation\FormValidationException;

class CommentController extends BaseController
{

    /**
     * @var CommentForm
     */
    protected $commentForm;

    /**
     * @var CommentCreationService
     */
    protected $comment;

    protected $user;

    /**
     * @param CommentForm $commentForm
     * @param CommentCreationService $comment
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, CommentForm $commentForm, CommentCreationService $comment)
    {
        $this->commentForm = $commentForm;
        $this->user = $user;
        $this->comment = $comment;

        $profilePicture = $this->user->profilePicture(Auth::user());
        View::share('profilePicture', $profilePicture);
    }

    /**
     * Post a comment and add it to the database
     * @return  Response
     */
    public function create()
    {

        // Validate the user input
        try {
            $this->commentForm->validate(Input::all());
        } catch(FormValidationException $e) {
            // If validation failed
            return Response::json([
                'error' => 'true',
                'message' => 'Comment cannot be empty!'
            ]);
        }

        // Validation passed, So we insert it to database
        $this->comment->create(Input::all(), Auth::user()->id);

        // Get the html content from the view
        $html = View::make('posts.comment-insert')->render();

        // Return a feedback
        return Response::json([
            'html'    => $html,
            'message' => 'Your comment has been successfully posted.'
        ]);

    }
} 