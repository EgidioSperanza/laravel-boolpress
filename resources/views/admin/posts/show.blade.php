@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-light">
                <div class="card-header">
                    {{ $post->title }}
                </div>
                <div class="card-body">
                    <p>Autore: <strong>{{$post->user->name}}</strong></p>
                    <p>{{ $post->content }}</p>
                    <hr />
                    @if ($post->category->id !== 1)
                    <p>Categoria: <span class="bg-light text-dark p-1 rounded">{{ $post->category->name }}</span></p>
                    @endif
                    Tags:
                        @forelse ($post->tags as $tag)
                            <span class="bg-primary p-1 rounded me-1">{{ $tag->name }}</span>
                            @empty
                            <span class="btn btn-outline-light p-1 rounded">Nessun Tag</span>
                        @endforelse
                    <div class="small text-end">
                        @if($post->created_at==$post->updated_at)
                            <span>Pubblicato il {{$post->created_at->format('d-m-Y')}} alle {{$post->created_at->format('H:m')}}</span>
                            @else
                            <span>Modificato il {{$post->updated_at->format('d-m-Y')}} alle {{$post->updated_at->format('H:m')}}</span>
                            @endif
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <div class=" ms-auto">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary me-2" title="Indietro">
                            <i class="bi bi-arrow-left-square"></i>
                        </a>
                        @include('partials.destroybtn')
                        @include('partials.updatebtn')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
