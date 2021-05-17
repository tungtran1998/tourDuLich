<?php

use Illuminate\Database\Seeder;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('role_admin')->insert([
        	'role_id'=>2,
        	'admin_id'=>2
        ]);
    }
}
