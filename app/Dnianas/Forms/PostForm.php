<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class PostForm extends FormValidator
{
    /**
     * Validation rules for when the user creates a post
     * @var array
     */
    protected $rules = [
        'post_content' => 'required'
    ];
    
}