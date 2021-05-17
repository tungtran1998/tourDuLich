<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $guarded = ['id'];
    protected $timestrap = true;

    //relationship with user model many to many
    public function admin(){
        return $this->belongsToMany('App\Models\Admin','role_admin','role_id', 'admin_id');
    }
    //many to many with permission
    public function permission(){
        return $this->belongsToMany('App\Models\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}
