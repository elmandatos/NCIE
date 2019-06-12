<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombres' => 'ADMIN',
            'apellidos' => 'NCIE',
            'sexo' => 'NONE',
            'telefono' => 'NONE',
            'email' => 'none@gmail.com',
            'matricula' => 'NONE',
            'carrera' => 'NONE',
            'rol' => 'ROOT',
            'tipo_de_usuario' => 'ADMIN',
            'foto' => 'img/users/user-man.png',
            'carrera' => 'NONE',
            'password' => bcrypt('1234'),
        ]);
    }
}
