<?php
use Dnianas\User\UserRepository;
use Dnianas\Comment\CommentCreationService;
use Dnianas\Forms\CommentForm;
use Laracasts\Validation\FormValidationException;

use Dnianas\Notification\NotificationRepository;

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

    protected $notification;

    /**
     * @param CommentForm $commentForm
     * @param CommentCreationService $comment
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, CommentForm $commentForm, CommentCreationService $comment,
            NotificationRepository $notificationRepository)
    {
        $this->commentForm = $commentForm;
        $this->user = $user;
        $this->comment = $comment;
        $this->notification = $notificationRepository;
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

        // Inform the user about the action.
        $this->notification->send(Auth::user()->id, Input::get('user_id'), Input::get('post_id'), 'Post', 'Comment');

        // Get the html content from the view
        $html = View::make('posts.comment-insert')->render();

        // Return a feedback
        return Response::json([
            'html'    => $html,
            'message' => 'Your comment has been successfully posted.'
        ]);

    }
} 