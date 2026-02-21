<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoriaExtraSeeder::class,
            ExtraSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}
