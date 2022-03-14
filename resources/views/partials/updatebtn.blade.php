@if(Auth::user()->name===$post->author)
<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning me-2">Modifica</a>
@endif
  