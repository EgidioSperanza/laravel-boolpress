@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="row g-3 add_form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="helpId" placeholder="Title" value="{{$post->title}}">
                    @error('title')
                    <div class="invalid-feedback bg-warning p-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Post</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" aria-describedby="helpId" placeholder="Inizia a scrivere qualcosa...">{{$post->content}}
                    </textarea>
                    @error('content')
                    <div class="invalid-feedback bg-warning p-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-secondary me-3" href="{{ route('admin.posts.show', $post->slug) }}">Annulla</a>
                    <button class="btn btn-success me-3" type="submit">Salva</button>
            </form>
            @include ('partials.destroybtn')
                </div>
        </div>
    </div>
</div>
@endsection