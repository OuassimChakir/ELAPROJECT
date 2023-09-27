<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenses')->insert([
            'designation' => 'Paiement du Professeurs',
            'code' => 1
        ]);

        DB::table('expenses')->insert([
            'designation' => 'Paiement du Staffs',
            'code' => 0
        ]);
    }
}
