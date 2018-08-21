<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseModel extends Model
{
    static $rules = [];

    static function validate(Request $request) {
        $result = $request->validate(static::$rules);
        return $result;
    }
}
