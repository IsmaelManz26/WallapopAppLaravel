<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Electrónica']);
        Category::create(['name' => 'Motos']);
        Category::create(['name' => 'Coches']);
        Category::create(['name' => 'Deporte']);
        Category::create(['name' => 'Hogar']);
        Category::create(['name' => 'Tecnología']);
        Category::create(['name' => 'Moda']);
        Category::create(['name' => 'Juguetes']);
        Category::create(['name' => 'Libros']);
        Category::create(['name' => 'Otros']);
    }
}
