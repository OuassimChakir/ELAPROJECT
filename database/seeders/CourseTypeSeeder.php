<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coursetype')->insert([
            'course' => 'Cours de Soutien',
            'shortForm' => 'CS'
        ]);
        DB::table('coursetype')->insert([
            'course' => 'Communication',
            'shortForm' => 'C'
        ]);
        DB::table('coursetype')->insert([
            'course' => 'Formation',
            'shortForm' => 'F'
        ]);
    }
}
