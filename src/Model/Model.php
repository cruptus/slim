<?php

namespace App\Model;

use Respect\Validation\Validator;


abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * Retourne si le model est valide
     * @return bool
     */
    public function isValid():bool {
        $this->rules();
        return $this->validator->validate((object)$this->attributes);
    }

    /**
     * Initialise la validation des fields
     */
    public abstract function rules();
}