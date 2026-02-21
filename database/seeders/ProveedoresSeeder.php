<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proveedores')->insert([
            ['nombre' => 'Kayfa', 'telefono' => '2222-2222', 'estado' => true],
            ['nombre' => 'Zona digital',        'telefono' => '7777-7777', 'estado' => true],
            ['nombre' => 'Itelmax',   'telefono' => '2333-4444', 'estado' => true],
        ]);
    }
}