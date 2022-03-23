@if(Auth::user()->id===$post->user_id)
<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning me-2" title="Modifica"><i class="bi bi-pencil-square"></i></a>
@endif
  