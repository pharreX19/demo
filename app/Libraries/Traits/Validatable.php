<?php

namespace App\Libraries\Traits;

use Illuminate\Support\Facades\Validator;

trait Validatable
{
    public static function validate(array $data)
    {
        $rules = isset(self::$validation_rules) ? self::$validation_rules : [];
        $messages = isset(self::$validation_messages) ? self::$validation_messages : [];
        return Validator::make($data, $rules, $messages);
    }
    // public function isValid()
    // {
    //     return (Validator::make($this->toArray(), self::$validation_rules))->fails();
    // }
}
