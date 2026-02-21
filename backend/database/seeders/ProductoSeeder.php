<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Sopa de Gallina India', 'slug' => 'sopa-de-gallina-india', 'categoria_slug' => 'sopas', 'descripcion' => 'Tradicional sopa salvadoreña con gallina criolla', 'incluye' => 'Sopa, 1 porción de gallina, 2 tortillas, 1 fresco', 'precio' => 4.50, 'es_menu_del_dia' => true, 'orden' => 1],
            ['nombre' => 'Sopa de Frijoles con Costilla', 'slug' => 'sopa-de-frijoles-con-costilla', 'categoria_slug' => 'sopas', 'descripcion' => 'Frijoles negros con costilla de cerdo ahumada', 'incluye' => 'Sopa, costilla, arroz, 2 tortillas', 'precio' => 4.00, 'es_menu_del_dia' => false, 'orden' => 2],
            ['nombre' => 'Sopa de Pollo', 'slug' => 'sopa-de-pollo', 'categoria_slug' => 'sopas', 'descripcion' => 'Sopa casera con pollo tierno y vegetales', 'incluye' => 'Sopa, pollo, arroz, 2 tortillas', 'precio' => 3.50, 'es_menu_del_dia' => false, 'orden' => 3],
            ['nombre' => 'Sopa de Chipilín', 'slug' => 'sopa-de-chipilin', 'categoria_slug' => 'sopas', 'descripcion' => 'Sopa de hierba chipilín con huevo y queso', 'incluye' => 'Sopa, huevo, queso, 2 tortillas', 'precio' => 3.00, 'es_menu_del_dia' => false, 'orden' => 4],
            ['nombre' => 'Sopa de Mora', 'slug' => 'sopa-de-mora', 'categoria_slug' => 'sopas', 'descripcion' => 'Exótica sopa de mora con carne de res', 'incluye' => 'Sopa, carne, arroz, 2 tortillas', 'precio' => 3.50, 'es_menu_del_dia' => false, 'orden' => 5],
            
            ['nombre' => 'Carne Asada', 'slug' => 'carne-asada', 'categoria_slug' => 'carnes', 'descripcion' => 'Corte de carne asada al carbón', 'incluye' => 'Carne, arroz, ensalada, 2 tortillas', 'precio' => 5.00, 'es_menu_del_dia' => true, 'orden' => 1],
            ['nombre' => 'Pollo Asado', 'slug' => 'pollo-asado', 'categoria_slug' => 'carnes', 'descripcion' => 'Pollo jugoso asado al carbón', 'incluye' => 'Pollo, arroz, ensalada, 2 tortillas', 'precio' => 4.00, 'es_menu_del_dia' => false, 'orden' => 2],
            ['nombre' => 'Camarones Empanizados', 'slug' => 'camarones-empanizados', 'categoria_slug' => 'carnes', 'descripcion' => 'Camarones frescos empanizados y fritos', 'incluye' => 'Camarones, arroz, ensalada, 2 tortillas', 'precio' => 6.00, 'es_menu_del_dia' => false, 'orden' => 3],
            ['nombre' => 'Pescado Frito', 'slug' => 'pescado-frito', 'categoria_slug' => 'carnes', 'descripcion' => 'Mojarra frita crujiente', 'incluye' => 'Pescado, arroz, ensalada, 2 tortillas', 'precio' => 5.50, 'es_menu_del_dia' => false, 'orden' => 4],
            
            ['nombre' => 'Carne Guisada', 'slug' => 'carne-guisada', 'categoria_slug' => 'platos-varios', 'descripcion' => 'Carne de res en salsa de tomate', 'incluye' => 'Carne, arroz, 2 tortillas', 'precio' => 4.00, 'es_menu_del_dia' => false, 'orden' => 1],
            ['nombre' => 'Carne Deshilachada', 'slug' => 'carne-deshilachada', 'categoria_slug' => 'platos-varios', 'descripcion' => 'Carne desmenuzada con especias', 'incluye' => 'Carne, arroz, 2 tortillas', 'precio' => 3.50, 'es_menu_del_dia' => false, 'orden' => 2],
            ['nombre' => 'Sopa de Tortillas', 'slug' => 'sopa-de-tortillas', 'categoria_slug' => 'platos-varios', 'descripcion' => 'Panes con pollo y vegetales', 'incluye' => 'Panes, pollo, huevo, 2 tortillas', 'precio' => 3.00, 'es_menu_del_dia' => false, 'orden' => 3],
            ['nombre' => 'Yuca con Chicharrón', 'slug' => 'yuca-con-chicharron', 'categoria_slug' => 'platos-varios', 'descripcion' => 'Yuca frita con chicharrón y curtido', 'incluye' => 'Yuca, chicharrón, curtido, 2 tortillas', 'precio' => 3.50, 'es_menu_del_dia' => false, 'orden' => 4],
            ['nombre' => 'Pupusas (3 unidades)', 'slug' => 'pupusas-3', 'categoria_slug' => 'platos-varios', 'descripcion' => 'Pupusas de queso, frijol o revueltas', 'incluye' => '3 pupusas, curtido', 'precio' => 2.50, 'es_menu_del_dia' => false, 'orden' => 5, 'permite_extras' => false],
            
            ['nombre' => 'Horchata', 'slug' => 'horchata', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Fresco de horchata tradicional', 'incluye' => 'Vaso grande', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 1, 'permite_extras' => false],
            ['nombre' => 'Cebada', 'slug' => 'cebada', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Refrescante cebada', 'incluye' => 'Vaso grande', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 2, 'permite_extras' => false],
            ['nombre' => 'Tamarindo', 'slug' => 'tamarindo', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Fresco natural de tamarindo', 'incluye' => 'Vaso grande', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 3, 'permite_extras' => false],
            ['nombre' => 'Chan', 'slug' => 'chan', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Bebida de semillas de chan', 'incluye' => 'Vaso grande', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 4, 'permite_extras' => false],
            ['nombre' => 'Ensalada', 'slug' => 'ensalada-fruta', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Bebida de frutas picadas', 'incluye' => 'Vaso grande con frutas', 'precio' => 1.50, 'es_menu_del_dia' => false, 'orden' => 5, 'permite_extras' => false],
            ['nombre' => 'Coca-Cola', 'slug' => 'coca-cola', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Soda Coca-Cola', 'incluye' => 'Lata 355ml', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 6, 'permite_extras' => false],
            ['nombre' => 'Fanta', 'slug' => 'fanta', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Soda Fanta naranja', 'incluye' => 'Lata 355ml', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 7, 'permite_extras' => false],
            ['nombre' => 'Sprite', 'slug' => 'sprite', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Soda Sprite', 'incluye' => 'Lata 355ml', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 8, 'permite_extras' => false],
            ['nombre' => 'Kolashampan', 'slug' => 'kolashampan', 'categoria_slug' => 'bebidas-frias', 'descripcion' => 'Soda salvadoreña Kolashampan', 'incluye' => 'Lata 355ml', 'precio' => 0.75, 'es_menu_del_dia' => false, 'orden' => 9, 'permite_extras' => false],
        ];

        foreach ($productos as $productoData) {
            $categoria = Categoria::where('slug', $productoData['categoria_slug'])->first();
            if ($categoria) {
                $data = $productoData;
                unset($data['categoria_slug']);
                $data['categoria_id'] = $categoria->id;
                $data['activo'] = true;
                $data['disponible'] = true;
                $data['permite_extras'] = $data['permite_extras'] ?? true;
                
                Producto::firstOrCreate(
                    ['slug' => $data['slug']],
                    $data
                );
            }
        }

        $this->command->info('Productos creados');
    }
}
