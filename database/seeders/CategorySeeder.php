<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Детский', 'Студенческий', 'Взрослый'];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(['name' => $category]);
        }
    }
}
