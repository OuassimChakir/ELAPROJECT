<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                    'name' => Storage::get('config.txt').' Admin',
                    'username' => 'admin',
                    'password' => Hash::make('admin123'),
                    'idRole' => $role->idRole,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

    }
}
