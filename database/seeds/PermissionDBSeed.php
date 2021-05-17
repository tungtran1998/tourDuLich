<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionDBSeed extends Seeder
{
    public function run()
    {
       $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-show',
           'tag-list',
           'tag-create',
           'tag-edit',
           'tag-delete',
           'tag-show',
           'roomtype-list',
           'roomtype-create',
           'roomtype-edit',
           'roomtype-delete',
           'roomtype-show',
           'service-list',
           'service-create',
           'service-edit',
           'service-delete',
           'service-show',
           'room-list',
           'room-create',
           'room-edit',
           'room-delete',
           'room-export',
           'room-show',
           'user-list',
           'user-edit',
           'user-delete',
           'user-export',
           'user-show',
           'admin-list',
           'admin-create',
           'admin-edit',
           'admin-delete',
           'admin-show',
           'price-list',
           'price-create',
           'price-edit',
           'price-delete',
           'price-show',
           'booking-list',
           'booking-edit',
           'booking-delete',
           'booking-export',
           'checkin-checkout-list',
           'checkin-checkout-edit',
           'checkin-checkout-show',
           'revenue-statistics-by-year',
           'revenue-statistics-by-month',
           'new-list',
           'new-create',
           'new-edit',
           'new-delete',
           'new-show',
           'cost-list',
           'cost-create',
           'cost-edit',
           'cost-delete',
           'cost-show',
           'feedback-list',
           'feedback-reply',
           'feedback-edit',
           'audit-list',
           'audit-show',
           'vote-list',
           'vote-show',
           'notification-show',
           'notification-showhight',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
