<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Throwable;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            // Crear Persona
            
            $personaId = DB::table('Persona')->insertGetId([
                'Nombre' => $faker->firstName,
                'Apellido' => $faker->lastName,
                'FechaNacimiento' => $faker->date('Y-m-d', '2000-01-01')
            ]);

            // Crear Domicilio
            DB::table('Domicilio')->insert([
                'Domicilio_detalle' => $faker->address,
                'rela_persona' => $personaId
            ]);

            // Crear PersonaDocumento
            DB::table('PersonaDocumento')->insert([
                'PersonaDocumento_desc' => $faker->randomNumber(8, true),
                'Persona_id_persona' => $personaId,
                'TipoDocumento_id_TipoDocumento' => 1
            ]);

            // Crear PersonaContacto
            DB::table('PersonaContacto')->insert([
                'PersonaContacto_desc' => $faker->phoneNumber,
                'rela_persona' => $personaId,
                'rela_tipocontacto' => 1
            ]);

            // Crear Usuario
            DB::table('Usuario')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Cambia esto por el hash de la contraseña que desees
                'rela_persona' => $personaId
            ]);
        }
    
    }
}

