@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 border p-5">
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
                    <label for="category_id" class="form-label">Categoria</label>
                    <select name="category_id" class="form-select">
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($post->category_id === $category->id) selected @endIf>
                          {{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <p>Tags</p>
                    @foreach ($tags as $tag)
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                          id="tag_{{ $tag->id }}" name="tags[]" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                        <label class="form-check-label text-light" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                      </div>
                    @endforeach
                    @error('tags')
                      <div class="text-red">{{ $message }}</div>
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
