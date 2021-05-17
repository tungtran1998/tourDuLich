<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
	use Notifiable;
	use HasRoles;

	protected $table = 'admins';
    protected $guarded = ['id'];
    protected $timestamp = true;

	//many to many with role
    public function role(){
        return $this->belongsToMany('App\Models\Role', 'role_admin', 'admin_id', 'role_id');
    }
}