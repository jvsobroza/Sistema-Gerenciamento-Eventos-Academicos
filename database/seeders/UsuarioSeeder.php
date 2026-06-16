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
            'email' => 'admin@gmail.com',
            'senha' => Hash::make('admin123'),
            'tipo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}