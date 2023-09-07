<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incomes')->insert([
            'designation' => 'Janvier',
            'description' => 'Facture à payer du mois Janvier',
            'activationDate' => '01'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Février',
            'description' => 'Facture à payer du mois Février',
            'activationDate' => '02'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Mars',
            'description' => 'Facture à payer du mois Mars',
            'activationDate' => '03'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Avril',
            'description' => 'Facture à payer du mois Avril',
            'activationDate' => '04'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Mai',
            'description' => 'Facture à payer du mois Mai',
            'activationDate' => '05'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Juin',
            'description' => 'Facture à payer du mois Juin',
            'activationDate' => '06'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Juillet',
            'description' => 'Facture à payer du mois Juillet',
            'activationDate' => '07'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Août',
            'description' => 'Facture à payer du mois Août',
            'activationDate' => '08'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Septembre',
            'description' => 'Facture à payer du mois Septembre',
            'activationDate' => '09'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Octobre',
            'description' => 'Facture à payer du mois Octobre',
            'activationDate' => '10'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Novembre',
            'description' => 'Facture à payer du mois Novembre',
            'activationDate' => '11'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Décembre',
            'description' => 'Facture à payer du mois Décembre',
            'activationDate' => '12'
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Inscription',
            'description' => "Frais d'inscription",
            'activationDate' => '00',
            'fixedAmount' => 0
        ]);
        DB::table('incomes')->insert([
            'designation' => 'Assurance',
            'description' => "Frais d'assurance",
            'activationDate' => '00',
            'fixedAmount' => 0
        ]);
        
    }
}
