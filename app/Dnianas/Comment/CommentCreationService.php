<?php

namespace Dnianas\Comment;


use Carbon\Carbon;
use Comment;

class CommentCreationService
{


    /**
     * Insert a new comment to the database
     *
     * @param $input
     * @param $user_id
     * @return \Comment
     */
    public function create($input, $user_id)
    {
        $comment = new Comment;
        $comment->text          = $input['text'];
        $comment->post_id       = $input['post_id'];
        $comment->user_id       = $user_id;
        $comment->posted_date   = Carbon::now();

        $comment->save();
    }

} 