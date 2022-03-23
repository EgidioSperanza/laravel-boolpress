<?php

use Illuminate\Database\Seeder;
use Faker\Generator  as Faker;
use App\Post;

class postsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <50 ; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker->words(3, true);
            $newPost->content = $faker->paragraph();
            $newPost->slug = $newPost->title;
            $newPost->user_id = rand(1, 22);
            $newPost->category_id = rand(1, 9);
            $newPost->save();
        }
    }
}
