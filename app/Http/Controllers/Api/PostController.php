<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use SlugGenerator;

    public function index() {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(6);
        $posts->load('user', 'category', 'tags');
        return response()->json($posts);
    }

    public function store(PostStoreRequest $request) {

        $data = $request->validated();

        $post = new Post();
        $post->fill($data);
        //TODO:temporaneamente assegnamo id creatore
        $post->user_id = 1;
        $post->slug = $this->generateSlug($post->title);
        $post->save();

        if (key_exists("tags", $data)) {
            $post->tags()->attach($data["tags"]);
        }

        return response()->json($post);
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->first();
        $post->load('user', 'category', 'tags');

        if (!$post) {
            abort(404);
          }

        return response()->json($post);
    }
}
