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
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use SlugGenerator;

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        // $posts = Post::orderBy('created_at', 'DESC')->where("id","=",100)->paginate(10);
        $posts->load('user', 'category', 'tags');

        $posts->each(function ($post) {
            if ($post->url) {
                $post->url = asset('storage/' . $post->url);
            } else {
                $post->url = 'https://via.placeholder.com/1024x480';
            }
        });
        return response()->json($posts);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(['categories' => $categories, 'tags' => $tags]);
    }

    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $post->fill($data);
        $post->slug = $this->generateSlug($post->title);
        $post->user_id = Auth::user()->id;
        if (key_exists('url', $data)) {
            $post->url = Storage::put('postImg', $data['url']);
        }
        $post->save();

        if (key_exists('tags', $data)) {
            $post->tags()->attach($data['tags']);
        }

        return response()->json($post);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->load('user', 'category', 'tags');

        if (!$post) {
            abort(404);
        }

        if ($post->url) {
            $post->url = asset('storage/' . $post->url);
        } else {
            $post->url = 'https://via.placeholder.com/1024x480';
        }

        return response()->json($post);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $post->load('user', 'category', 'tags');

        if ($post->url) {
            $post->url = asset('storage/' . $post->url);
        } else {
            $post->url = 'https://via.placeholder.com/1024x480';
        }

        return response()->json([
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $data=$request->validated();

        $post->update($data);

        if (key_exists("url", $data)) {
            if ($post->url) {
              Storage::delete($post->coverImg);
            }
      
            $url = Storage::put("postImg", $data["url"]);
      
            $post->url = $url;
            $post->save();
        }

       key_exists("tags", $data) && count($data["tags"])!=0 ? $post->tags()->sync($data["tags"]) : $post->tags()->sync([]);

       return response()->json([
        'status' => 'OK',
        'message' => 'Announcement updated.',
    ]);
}

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();

        if ($post->url) {
            Storage::delete($post->url);
        }

        $post->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Announcement deleted.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }
}
