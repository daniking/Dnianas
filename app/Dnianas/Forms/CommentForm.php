<?php

namespace Dnianas\Forms;


use Laracasts\Validation\FormValidator;

class CommentForm extends FormValidator
{
    protected $rules = [
        'post_id' => 'numeric|min:1|integer|exists:posts,id',
        'text'    => 'required'
    ];
}