<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $guarded = ['id'];
    protected $timestrap = true;

    //relationship with role model many to many
    public function role(){
        return $this->belongsToMany('App\Models\Role','permission_role','permission_id', 'role_id');
    }
}
