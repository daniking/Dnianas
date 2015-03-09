<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class ProfilePictureForm extends FormValidator
{
    /**
     * Validation rules for login
     * @var array
     */
    protected $rules = [
        'profile_picture' => 'required|min:10|image|real_image|'
    ];
    
}