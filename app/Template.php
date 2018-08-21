<?php

namespace App;

use App\BaseModel;

class Template extends BaseModel
{
    protected $table = 'template';

    static $rules = [
        'name'          => 'string|required',
        'path'          => 'string|required',
        'description'   => 'string|nullable',
    ];
    public $fillable = [
        'name',
        'path',
        'description',
    ];

    public function sites() {
        return $this->hasMany('App\Site', 'id_template');
    }
}
