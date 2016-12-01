<?php

namespace App\Model;


use Respect\Validation\Validator as v;


class User extends Model{

    protected $fillable = ['name'];

    public function rules()
    {
        $this->validator = v::attribute('name', v::stringType()->length(6,32));
    }
}