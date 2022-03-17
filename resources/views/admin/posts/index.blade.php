@extends('layouts.app')
@php
    use Carbon\CarbonInterface;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-light">
                <div class="card-header d-flex">
                    Posts
                    <a href="{{route('admin.posts.create')}}" class="nav-link ms-auto">
                        Nuovo Post <i class="bi bi-plus-square-fill"></i>
                    </a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ( $posts as $post )
                        <li class="list-group-item bg-dark text-white border-secondary">
                            <h3>{{$post->title}} </h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p>Autore: <strong>{{$post->user->name}}</strong>
                                        @if ($post->category->id !== 1)
                                        <p>Categoria: <span class="bg-light text-dark p-1 rounded">{{ $post->category->name }}</span></p>
                                        @endif
                                        <p>Tags:
                                        @forelse ($post->tags as $tag)
                                            <span class="bg-primary p-1 rounded me-1">{{ $tag->name }}</span>
                                            @empty
                                            <span class="btn btn-outline-light p-1 rounded">Nessun Tag</span>
                                        @endforelse
                                    </p>
                                </div>
                                <div class="d-flex">
                                    @include('partials.destroybtn')
                                    @include('partials.updatebtn')
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary" title="Leggi">
                                        <i class="bi bi-book"></i>
                                    </a>
                                </div>
                            </div>
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
                        </li>
                        @endforeach
                      </ul>
                </div>
                @if(count($posts)>10)
                <div class="card-footer d-flex">
                    Posts
                    <a href="{{route('admin.posts.create')}}" class="nav-link ms-auto">
                        Nuovo Post <i class="bi bi-plus-square-fill"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection