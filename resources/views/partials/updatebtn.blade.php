@if(Auth::user()->id===$post->user_id)
<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning me-2">Modifica</a>
@endif
  