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
        $user1 = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@aveasgroup.com',
            'password' => Hash::make(12345678),
        ]);
		
		$user1->assignRole('Super Admin');
		
        $user2 = User::create([
            'name' => 'Gading Pradana',
            'email' => 'manager@tvip.com',
            'password' => Hash::make(12345678),
        ]);
		
		$user2->assignRole('Manager');
		
        $user3 = User::create([
            'name' => 'Yoga Wibisono',
            'email' => 'admingudang@tvip.com',
            'password' => Hash::make(12345678),
        ]);
		
		$user3->assignRole('Admin Gudang');
		
        $user4 = User::create([
            'name' => 'Puji Novitasari',
            'email' => 'admincro@tvip.com',
            'password' => Hash::make(12345678),
        ]);
		
		$user4->assignRole('Admin CRO');
		
        $user5 = User::create([
            'name' => 'Rika Melani',
            'email' => 'customer@tvip.com',
            'password' => Hash::make(12345678),
        ]);
		
		$user5->assignRole('Customer');
    }
}
