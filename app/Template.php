<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ValidatorTrait;

class Template extends Model 
{
    use ValidatorTrait;

    const TYPE_HIDDEN  = '0';
    const TYPE_PRIVATE = '1'; // custom for each user
    const TYPE_PREMIUM = '2';
    const TYPE_FREE    = '3';

    protected $table = 'template';

    static function rules($model=null) {
       return [
            'name'          => 'string|required',
            'path'          => 'string|required',
            'description'   => 'string|nullable',
            'type'          => 'integer|nullable',
            'id_user'       => 'integer|nullable',
        ];
    }

    public $fillable = [
        'name',
        'path',
        'description',
        'type',
        'id_user',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function sites() {
        return $this->hasMany('App\Site', 'id_template');
    }
}
