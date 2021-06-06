<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'name' => 'Super Admin',
        	'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        
        DB::table('model_has_roles')->insert([
        	'role_id' => 1,
        	'model_type' => 'App\Models\User',
        	'model_id' => 1
        ]);
    }
}
