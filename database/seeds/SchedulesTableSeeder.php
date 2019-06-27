<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hora_inicio = 9;
        $hora_fin = 10;
        do{
            DB::table('schedules')->insert([
            'hora_inicio' => $hora_inicio.":00",
            'hora_fin' => $hora_fin.":00",
            ]);
            $hora_inicio++;
            $hora_fin++;
        }while($hora_fin<20);
    }
}
