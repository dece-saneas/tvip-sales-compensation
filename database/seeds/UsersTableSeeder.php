<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            0 => [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'role' => 'Super Admin'
            ],
            1 => [
                'name' => 'Manager',
                'email' => 'manager@tvip.com',
                'role' => 'Manager'
            ],
            2 => [
                'name' => 'Admin Gudang',
                'email' => 'admin.gudang@tvip.com',
                'role' => 'Admin Gudang'
            ],
            3 => [
                'name' => 'Admin CRO',
                'email' => 'admin.cro@tvip.com',
                'role' => 'Admin CRO'
            ],
            4 => [
                'name' => 'Customer',
                'email' => 'customer@tvip.com',
                'role' => 'Customer'
            ]
        ];
        
        foreach ($users as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make(12345678),
            ]);
            
            $newUser->assignRole($user['role']);
        }
    }
}
