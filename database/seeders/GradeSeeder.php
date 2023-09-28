<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert(['grade' => '1ère Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '2ème Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '3ème Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '4ème Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '5ème Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '6ème Année','idGradeCategory' => '1']);
        DB::table('grades')->insert(['grade' => '1ère Année','idGradeCategory' => '3']);
        DB::table('grades')->insert(['grade' => '2ème Année','idGradeCategory' => '3']);
        DB::table('grades')->insert(['grade' => '3ème Année','idGradeCategory' => '3']);
        DB::table('grades')->insert(['grade' => 'A1','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'A2','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'B1','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'B2','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'C1','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'C2','idGradeCategory' => '2']);
        DB::table('grades')->insert(['grade' => 'TC - Sciences','idGradeCategory' => '5']);
        DB::table('grades')->insert(['grade' => 'TC - Technologies','idGradeCategory' => '5']);
        DB::table('grades')->insert(['grade' => 'TC - LSH','idGradeCategory' => '5']);
        DB::table('grades')->insert(['grade' => '1BAC - SM','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '1BAC - ScEX','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '1BAC - STE','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '1BAC - STM','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '1BAC - SEG','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '1BAC - LSH','idGradeCategory' => '6']);
        DB::table('grades')->insert(['grade' => '2BAC - SM A','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - SM B','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - SPC','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - SVT','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - AGRO','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - STM','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - STE','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - ScEco','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - SGC','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - Lettre','idGradeCategory' => '7']);
        DB::table('grades')->insert(['grade' => '2BAC - SH','idGradeCategory' => '7']);
    }
}
