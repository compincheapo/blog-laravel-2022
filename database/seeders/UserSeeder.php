<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([                  //Definimos nuestra credencial para ingresar al sistema.
            'name' => 'Compinche',
            'email' => 'compincheapo@gmail.com',
            'password' => bcrypt('compinche')
        ])->assignRole('Admin');                /* Le asignamos el rol de admin a este usuario. AssignRole solo es para un rol. */

        User::factory(99)->create(); //Crea 99 usuarios en la BD.
    }
}
