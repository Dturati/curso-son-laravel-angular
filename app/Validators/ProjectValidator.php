<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
    	'name' => 'required|max:255',
    	'description' => 'required|max:255',
    	'status' => 'required',
    	'due_date' => 'required|date'
    ];

}