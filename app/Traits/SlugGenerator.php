<?php
namespace App\Traits;

use App\Post;
use Illuminate\SupporT\Str;

trait SlugGenerator {
    protected function generateSlug($slugReference){
        $slug = Str::slug($slugReference);

        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
            $newSlug = $slug . "-" . $counter;
            $counter++;

            $exists = Post::where("slug", $newSlug)->first();

            if (!$exists) {
            $slug = $newSlug;
            }
        }

        return $slug;
    }
}
