<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(['name' => 'politics', 'description' => 'Category about politics']);
        Category::insert(['name' => 'funny', 'description'=> 'Category for having some fun']);
        Category::insert(['name' => 'science', 'description' => 'Category where you can self-develop']);
        Category::insert(['name' => 'films', 'description' => 'Category about great films']);
    }
}
