<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class GettingStarted extends FormValidator
{
    /**
     * Validation rules for login
     * @var array
     */
    protected $rules = [
        'address'   => 'required|min:4',
        'job_title' => 'required|min:5',
        'website'   => 'required|url',
        'about'     => 'required|min:10|max:140'
    ];
    
}