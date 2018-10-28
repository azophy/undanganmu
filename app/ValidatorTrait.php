<?php

namespace App;

use Illuminate\Http\Request;

Trait ValidatorTrait 
{
    /* method to validate request. could be feed with the model object */
    static function validate(Request $request, $additional_rules = [], $model=null) {
        $final_rules = ($model != null) ?
            array_merge(static::rules($model), $additional_rules) :
            array_merge(static::rules(), $additional_rules) ;

        return $request->validate($final_rules);
    }

    /* Return array of rule. could take object model as argument */
    static function rules($model=null) {
        return [];
    }

}
