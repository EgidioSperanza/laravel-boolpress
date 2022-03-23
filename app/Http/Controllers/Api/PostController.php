<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Post;
use App\Tag;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use SlugGenerator;

    public function index() {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        // $posts = Post::orderBy('created_at', 'DESC')->where("id","=",100)->paginate(10);
        $posts->load('user', 'category', 'tags');

        $posts->each(function ($post) {
            if ($post->url) {
              $post->url = asset("storage/" . $post->url);
            }else{
              $post->url = "https://via.placeholder.com/1024x480";
            }
          });
        return response()->json($posts);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(['categories'=>$categories,'tags'=>$tags]);
    }

    public function store(PostStoreRequest $request) {

        $data = $request->validated();

        $post = new Post();
        $post->fill($data);
        $post->slug = $this->generateSlug($post->title);
        $post->user_id = Auth::user()->id;
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

        if ($post->url) {
            $post->url = asset("storage/" . $post->url);
        }else{
            $post->url = "https://via.placeholder.com/1024x480";
        }

        return response()->json($post);
    }
}
