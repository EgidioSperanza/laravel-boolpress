<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Category $newCategory)
    {
        $categories = [
            'Non Specificato',
            'Hardware',
            'Software', 
            'IT',
            'Mobile',
            'Social',
            'PHP',
            'Laravel',
            'VUE',
        ];

        foreach ($categories as $category){

            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->save();
        }
        
    }
}
