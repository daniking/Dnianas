<?php namespace Dnianas\Forms;

use Laracasts\Validation\FormValidator;

class CoverPhotoForm extends FormValidator
{
    /**
     * Validation rules for login
     * @var array
     */
    protected $rules = [
        'cover_photo' => 'required|min:10|image|real_image|'
    ];
    
}