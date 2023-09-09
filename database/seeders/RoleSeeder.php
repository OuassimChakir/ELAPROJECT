<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'Administrateur',
            'codeRole' => '00',
            'color' => '#ff0000'
        ]);
        DB::table('roles')->insert([
            'role' => 'Staff',
            'codeRole' => '11',
            'color' => '#0000ff'
        ]);
        DB::table('roles')->insert([
            'role' => 'Student',
            'codeRole' => '22',
            'color' => '#00ff00'
        ]);
        DB::table('roles')->insert([
            'role' => 'Professeur',
            'codeRole' => '33',
            'color' => '#ff00ff'
        ]);
    }
}
