<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Tag;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use \Carbon\CarbonInterface;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use SlugGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            "categories" => $categories,
            "tags" => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $post->fill($data);

        $slug = $this->generateSlug($post->title);
        $post->slug = $slug;
        $post->user_id = Auth::user()->id;

        if (key_exists("url", $data)) {
            $post->url = Storage::put("postImg", $data["url"]);
          }
      
          $post->save();

        if (key_exists("tags", $data)) {
            $post->tags()->attach($data["tags"]);
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            "post" => $post,
            "categories" => $categories,
            "tags" => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
            $post->tags()->detach();

            if ($post->url) {
                Storage::delete($post->url);
              }

            $post->delete();
    
            return redirect()->route('admin.posts.index');
    }
}

