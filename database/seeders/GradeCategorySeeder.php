<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gradescategories')->insert([
            'category' => 'Scolaire'
        ]);
        DB::table('gradescategories')->insert([
            'category' => 'Communication'
        ]);
        DB::table('gradescategories')->insert([
            'category' => 'Formation'
        ]);
    }
}
