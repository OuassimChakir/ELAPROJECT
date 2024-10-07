<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Roles::getRoles();
        foreach($roles as $role){
            if($role->codeRole == '00')
                DB::table('users')->insert([
                    'name' => 'ELA Admin',
                    'username' => 'admin',
                    'password' => Hash::make('bma123456789'),
                    'idRole' => $role->idRole,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

    }
}
