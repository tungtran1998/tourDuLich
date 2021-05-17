<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class abc extends Seeder
{
    public function run()
    {
       $permissions = [
           'provinces-list',
           'provinces-create',
           'provinces-edit',
           'provinces-delete',
           'provinces-show',

           'tours-list',
           'tours-create',
           'tours-edit',
           'tours-delete',
           'tours-show',
           'tours-export',

           'booktour-list',
           'booktour-edit',
           'booktour-export',

        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
