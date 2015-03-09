<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator
{
    /**
     * Validation rules for registration
     * @var array
     */
    protected $rules = [
        'first_name'       => 'required|min:2|max:16|alpha',
        'last_name'        => 'required|min:2|max:16|alpha',
        'username'         => 'required|min:3|max:32|alpha_num|unique:users',
        'email'            => 'required|email|unique:users',
        'password'         => 'required|min:6|max:32',
        'password_confirm' => 'required|min:6|same:password',
        'gender'           => 'required',
        'birth_day'        => 'required|not_in:0',
        'birth_month'      => 'required|not_in:0',
        'birth_year'       => 'required|not_in:0'
    ];

}