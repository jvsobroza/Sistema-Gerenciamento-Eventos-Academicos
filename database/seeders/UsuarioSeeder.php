<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuario')->insert([
            'nome' => 'Administrador',
            'email' => 'admin@email.com',
            'senha' => Hash::make('senha123'),
            'tipo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}