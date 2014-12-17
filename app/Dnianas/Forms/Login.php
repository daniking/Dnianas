<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class Login extends FormValidator
{
    /**
     * Validation rules for login
     * @var array
     */
    protected $rules = [
        'username' => 'required|',
        'password' => 'required|'
    ];
    
}