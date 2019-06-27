<?php

use Illuminate\Database\Seeder;

class CubiculesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservado = false;
        $reservados = [1,2,8];
        for ($i=1; $i < 11; $i++) { 
            if(in_array($i,$reservados))
                $reservado = true;          
            DB::table('cubicules')->insert([
                'numero' => $i,
                'reservado' => $reservado,
            ]);
            $reservado = false;
        }
    }
}
