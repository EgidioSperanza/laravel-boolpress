<div class="small text-end">
    @if ($post->created_at->diffInHours(now())>=12)
    <div>Pubblicato il {{$post->created_at->format('d/m/Y \a\l\l\e H:m')}}</div>
    @else
    <div>Pubblicato {{$post->created_at->locale('it')->diffForHumans(['options' => 0])}}</div>
    @endif
    @if ($post->updated_at->diffInSeconds($post->created_at)>0)
    <div>Ultima Modifica: {{$post->updated_at->locale('it')->diffForHumans(['options' => 0])}}</div>
    @endif
</div>
