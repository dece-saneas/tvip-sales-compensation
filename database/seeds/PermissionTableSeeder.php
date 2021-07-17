<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view product',
            'create product',
            'edit product',
            'delete product',
            
            'view reward',
            'create reward',
            'edit reward',
            'delete reward',
            
            'view user',
            'create user',
            'edit user',
            'delete user',
            
            'view supply',
            'create supply',
            'edit supply',
            'delete supply',
            
            'view order',
            'create order',
            'edit order',
            'delete order',
            'verify order',
            'process order',
        ];
        
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
