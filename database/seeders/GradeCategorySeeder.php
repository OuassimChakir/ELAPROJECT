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
        DB::table('expenses')->insert([
            'category' => 'Primaire',
            'description' => 'Niveaux des années Primaires',
            'idCourseType' => '1'
        ]);

        DB::table('expenses')->insert([
            'category' => 'Communication',
            'description' => 'Les niveaux de communication',
            'idCourseType' => '2'
        ]);

        DB::table('expenses')->insert([
            'category' => 'Collège',
            'description' => 'Niveaux de Collège',
            'idCourseType' => '1'
        ]);

        DB::table('expenses')->insert([
            'category' => 'Formation',
            'description' => 'Categorie des Formations',
            'idCourseType' => '3'
        ]);

        DB::table('expenses')->insert([
            'category' => 'TC',
            'description' => 'Niveaux du Tronc Commun',
            'idCourseType' => '1'
        ]);

        DB::table('expenses')->insert([
            'category' => '1BAC',
            'description' => '1ère année Bac',
            'idCourseType' => '1'
        ]);

        DB::table('expenses')->insert([
            'category' => '2BAC',
            'description' => '2ème année Bac',
            'idCourseType' => '1'
        ]);
    }
}
