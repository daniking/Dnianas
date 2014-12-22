<?php

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


    /**
     * @param CommentForm $commentForm
     * @param CommentCreationService $comment
     */
    public function __construct(CommentForm $commentForm, CommentCreationService $comment)
    {
        $this->commentForm = $commentForm;
        $this->comment = $comment;
    }

    /**
     *
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
        $html = View::make('comments.comment-insert')->render();


        return Response::json([
            'html'    => $html,
            'message' => 'Your comment has been successfully posted.'
        ]);

    }
} 