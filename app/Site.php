<?php

namespace App;

use App\BaseModel;

class Site extends BaseModel
{
    protected $table = 'site';

    static $rules = [
        'id_user'       => 'integer|required',
        'id_template'   => 'integer|required',
        'url_name'      => 'string|required',
        'page_title'    => 'string|required',
        'option'        => 'string|nullable',
    ];
    public $fillable = [
        'id_user',
        'id_template',
        'url_name',
        'page_title',
        'option',
    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function template() {
        return $this->hasOne('App\Template', 'id', 'id_template');
    }
}
