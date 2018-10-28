<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ValidatorTrait;

class Template extends Model 
{
    use ValidatorTrait;

    protected $table = 'template';

    static function rules($model=null) {
       return [
            'name'          => 'string|required',
            'path'          => 'string|required',
            'description'   => 'string|nullable',
        ];
    }

    public $fillable = [
        'name',
        'path',
        'description',
    ];

    public function sites() {
        return $this->hasMany('App\Site', 'id_template');
    }
}
