<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Sopas', 'slug' => 'sopas', 'descripcion' => 'Deliciosas sopas tradicionales salvadoreñas', 'icono' => 'heroicon-o-fire', 'orden' => 1, 'destacado' => true],
            ['nombre' => 'Carnes', 'slug' => 'carnes', 'descripcion' => 'Carnes asadas, guisadas y más', 'icono' => 'heroicon-o-cake', 'orden' => 2, 'destacado' => true],
            ['nombre' => 'Platos Varios', 'slug' => 'platos-varios', 'descripcion' => 'Variedad de platos típicos', 'icono' => 'heroicon-o-clipboard-list', 'orden' => 3, 'destacado' => false],
            ['nombre' => 'Bebidas Frías', 'slug' => 'bebidas-frias', 'descripcion' => 'Frescos naturales y sodas', 'icono' => 'heroicon-o-beaker', 'orden' => 4, 'destacado' => false],
            ['nombre' => 'Menú del Día', 'slug' => 'menu-del-dia', 'descripcion' => 'Especiales del día con precio especial', 'icono' => 'heroicon-o-star', 'orden' => 0, 'destacado' => true],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['slug' => $categoria['slug']],
                array_merge($categoria, ['activo' => true])
            );
        }

        $this->command->info('Categorías creadas');
    }
}
