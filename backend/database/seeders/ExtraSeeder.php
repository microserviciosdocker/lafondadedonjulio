<?php

namespace Database\Seeders;

use App\Models\CategoriaExtra;
use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtraSeeder extends Seeder
{
    public function run(): void
    {
        $extras = [
            ['nombre' => 'Tortilla de maíz', 'precio' => 0.15, 'categoria_extra_slug' => 'tortillas', 'orden' => 1],
            ['nombre' => 'Tortilla de arroz', 'precio' => 0.20, 'categoria_extra_slug' => 'tortillas', 'orden' => 2],
            
            ['nombre' => 'Queso fresco', 'precio' => 0.50, 'categoria_extra_slug' => 'lacteos', 'orden' => 1],
            ['nombre' => 'Cuajada', 'precio' => 0.75, 'categoria_extra_slug' => 'lacteos', 'orden' => 2],
            ['nombre' => 'Requesón', 'precio' => 0.50, 'categoria_extra_slug' => 'lacteos', 'orden' => 3],
            ['nombre' => 'Crema', 'precio' => 0.25, 'categoria_extra_slug' => 'lacteos', 'orden' => 4],
            
            ['nombre' => 'Huevo frito', 'precio' => 0.50, 'categoria_extra_slug' => 'proteinas', 'orden' => 1],
            ['nombre' => 'Doble ración carne', 'precio' => 1.50, 'categoria_extra_slug' => 'proteinas', 'orden' => 2],
            ['nombre' => 'Pollo extra', 'precio' => 1.00, 'categoria_extra_slug' => 'proteinas', 'orden' => 3],
            
            ['nombre' => 'Fresco adicional', 'precio' => 0.75, 'categoria_extra_slug' => 'bebidas-extra', 'orden' => 1],
            ['nombre' => 'Soda adicional', 'precio' => 0.75, 'categoria_extra_slug' => 'bebidas-extra', 'orden' => 2],
            
            ['nombre' => 'Arroz extra', 'precio' => 0.50, 'categoria_extra_slug' => 'guarniciones', 'orden' => 1],
            ['nombre' => 'Aguacate', 'precio' => 0.75, 'categoria_extra_slug' => 'guarniciones', 'orden' => 2],
            ['nombre' => 'Ensalada', 'precio' => 0.50, 'categoria_extra_slug' => 'guarniciones', 'orden' => 3],
        ];

        foreach ($extras as $extraData) {
            $categoriaExtra = CategoriaExtra::where('slug', $extraData['categoria_extra_slug'])->first();
            if ($categoriaExtra) {
                Extra::firstOrCreate(
                    ['nombre' => $extraData['nombre']],
                    [
                        'categoria_extra_id' => $categoriaExtra->id,
                        'precio' => $extraData['precio'],
                        'orden' => $extraData['orden'],
                        'activo' => true,
                    ]
                );
            }
        }

        $this->command->info('Extras creados');
    }
}
