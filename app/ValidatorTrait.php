<?php

namespace App;

use Illuminate\Http\Request;

Trait ValidatorTrait 
{
    static function validate(Request $request, $additional_rules = []) {
        $result = $request->validate(array_merge(static::$rules, $additional_rules));
        return $result;
    }
}
