<?php

namespace Database\Seeders;

use App\Models\CategoriaExtra;
use Illuminate\Database\Seeder;

class CategoriaExtraSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Tortillas', 'slug' => 'tortillas', 'descripcion' => 'Tortillas adicionales', 'orden' => 1, 'activo' => true, 'multiple' => true],
            ['nombre' => 'Lácteos', 'slug' => 'lacteos', 'descripcion' => 'Quesos, cremas y derivados', 'orden' => 2, 'activo' => true, 'multiple' => true],
            ['nombre' => 'Proteínas', 'slug' => 'proteinas', 'descripcion' => 'Agregados de carne o huevo', 'orden' => 3, 'activo' => true, 'multiple' => true],
            ['nombre' => 'Bebidas Extra', 'slug' => 'bebidas-extra', 'descripcion' => 'Bebidas adicionales', 'orden' => 4, 'activo' => true, 'multiple' => true],
            ['nombre' => 'Guarniciones', 'slug' => 'guarniciones', 'descripcion' => 'Arroz, ensaladas y más', 'orden' => 5, 'activo' => true, 'multiple' => true],
        ];

        foreach ($categorias as $categoria) {
            CategoriaExtra::firstOrCreate(
                ['slug' => $categoria['slug']],
                $categoria
            );
        }

        $this->command->info('Categorías de extras creadas');
    }
}
