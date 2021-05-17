<?php

use Illuminate\Database\Seeder;

class Update extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Schema::table('tags', function($table)
    	// {
    	// 	$table->boolean('isdeleted')->default(0)->after('slug');
    	// });
        //User admin
        // DB::table('permissions')->insert([
        //     'name'=>'index_User_admin',
        //     'label'=>'Index user admin',
        // ]);
        // DB::table('permissions')->insert([
        //     'name'=>'create_User_admin',
        //     'label'=>'Create user admin',
        // ]);
        // DB::table('permissions')->insert([
        //     'name'=>'edit_User_admin',
        //     'label'=>'Edit user admin',
        // ]);
        // DB::table('permissions')->insert([
        //     'name'=>'detail_User_admin',
        //     'label'=>'Detail user admin',
        // ]);
        DB::table('admins')->insert([
            'email'=>'admin@gmail.com',
            'name'=>'admin',
            'password'=> bcrypt('123'),
        ]);

        
    }
}
