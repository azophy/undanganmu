<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use App\ValidatorTrait;
use App\ConstantExportTrait;

class User extends Authenticatable
{
    use Notifiable;
    use ConstantExportTrait;
    use ValidatorTrait;

    const ROLE_GUEST = 0;
    const ROLE_USER  = 5;
    const ROLE_ADMIN = 10;

    private $_info=[]; // variabel untuk menyimpan data info user yg sudah berupa object

    static function rules($model=null) {
        $rules = [
            'name'     => 'string|required',
            'email'    => 'email|required',
            'password' => 'string|nullable',
            'username' => 'string|required|unique:users,username',
            'id_role'  => 'integer|nullable',
            'info'     => 'string|nullable',

            'info_data.contact_number.' => 'digits:10,14',
            'new_password' => 'string|nullable',
        ];

        // custom rules for updating models
        if ($model != null)
            $rules['username'] .= ','.$model->id;

        return $rules;
    }

    protected $attributes = array(
      'id_role' => self::ROLE_GUEST,
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'     ,
        'email'    ,
        'password' ,
        'username' ,
        'id_role'  ,
        'info',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ---------------------------------
    //
    public function is($role) {
        $role_const = 'self::ROLE_'.strtoupper($role);
        return $this->id_role == constant($role_const);
    }

    public function role() {
        $role_name = [
            0  => 'guest',
            5  => 'user',
            10 => 'admin',
        ];
        return $role_name[$this->id_role];
    }

    public function getInfoDataAttribute() {
        if (empty($this->_info)) 
            $this->_info = json_decode($this->info);
        return $this->_info;
    }

    public function site() {
        return $this->hasMany('App\Site', 'id_user');
    }
}
