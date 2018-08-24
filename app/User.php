<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public $rule = [
        'name'     => 'string',
        'email'    => 'email',
        'password' => 'string|nullable',
        'username' => 'string',
        'id_role'  => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is($role) {
        $role_const = 'self::ROLE_'.strtoupper($role);
        return $this->id_role == constant($role_const);
    }
}
