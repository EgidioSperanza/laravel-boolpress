<?php

use Illuminate\Database\Seeder;

class AddImageUrlSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->update([
            'url' => 'https://picsum.photos/200'
         ]);
    }
}
