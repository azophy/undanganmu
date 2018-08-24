<?php

namespace App;

use Illuminate\Http\Request;

Trait ValidatorTrait 
{
    static function validate(Request $request) {
        $result = $request->validate(static::$rules);
        return $result;
    }
}
