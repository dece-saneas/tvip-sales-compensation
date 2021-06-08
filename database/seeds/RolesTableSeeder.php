<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role1 = Role::create([
            'name' => 'Super Admin'
        ]);
		
		$role2 = Role::create([
            'name' => 'Manager'
        ]);
		
		$role3 = Role::create([
            'name' => 'Admin Gudang'
        ]);
		
		$role4 = Role::create([
            'name' => 'Admin CRO'
        ]);
		
		$role5 = Role::create([
            'name' => 'Customer'
        ]);
    }
}
