<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Laptop HP Pavilion',
            'precio' => 899.99,
            'estado' => true,
            'marca_id' => 1,
            'categoria_id' => 1,
            'proveedor_id' => 1,
        ]);

        Producto::create([
            'nombre' => 'Mouse Logitech MX',
            'precio' => 45.50,
            'estado' => true,
            'marca_id' => 2,
            'categoria_id' => 1,
            'proveedor_id' => 2,
        ]);

        Producto::create([
            'nombre' => 'Teclado Mecánico RGB',
            'precio' => 75.00,
            'estado' => true,
            'marca_id' => 1,
            'categoria_id' => 1,
            'proveedor_id' => 1,
        ]);
    }
}