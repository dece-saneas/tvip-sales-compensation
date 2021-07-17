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
        $roles = [
            0 => [
                'name' => 'Super Admin',
                'permission' => []
            ],
            1 => [
                'name' => 'Manager',
                'permission' => [1, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            ],
            2 => [
                'name' => 'Admin Gudang',
                'permission' => [1, 2, 3, 4, 5, 13, 14, 15, 16, 17, 22]
            ],
            3 => [
                'name' => 'Admin CRO',
                'permission' => [1, 5, 9, 10, 11, 12, 17, 21]
            ],
            4 => [
                'name' => 'Customer',
                'permission' => [1, 5, 17, 18, 19, 20]
            ]
        ];
        
        foreach ($roles as $role) {
            $newRole = Role::create([
                'name' => $role['name']
            ]);
            
            $newRole->syncPermissions($role['permission']);
        }
    }
}
