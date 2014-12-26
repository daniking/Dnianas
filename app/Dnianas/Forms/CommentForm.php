<?php 
namespace Dnianas\Forms;


use Laracasts\Validation\FormValidator;

class CommentForm extends FormValidator
{
    /**
     * Validation rules for comment form
     * @var array
     */
    protected $rules = [
        'post_id' => 'numeric|min:1|integer|exists:posts,id',
        'text'    => 'required'
    ];
}