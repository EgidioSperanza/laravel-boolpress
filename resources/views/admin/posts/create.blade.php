@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border p-5 bg-dark text-light">
          <div class="card-header d-flex">
            Crea un nuovo post
          </div>

          <div class="card-body">

            <form action="{{ route('admin.posts.store') }}" method="post">
              @csrf

              {{-- titolo --}}
              <div class="mb-3">
                <label>Titolo</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                  placeholder="Inserisci il titolo" value="{{ old('title') }}" required>
                @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="url" class="form-label">Image Url</label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" aria-describedby="helpId" placeholder="Image Url" value="{{old('url')}}">
                @error('url')
                <div class="invalid-feedback bg-warning p-2">{{$message}}</div>
                @enderror
            </div>
              <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select name="category_id" class="form-select">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                      {{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <p>Tags</p>
                @foreach ($tags as $tag)
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                      id="tag_{{ $tag->id }}" name="tags[]">
                    <label class="form-check-label text-light" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                  </div>
                @endforeach
                @error('tags')
                  <div class="text-red">{{ $message }}</div>
                @enderror
              </div>
              {{-- contenuto del post --}}
              <div class="mb-3">
                <label>Contenuto</label>
                <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                  placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                @error('content')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="card-footer form-group">
                  <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Annulla</a>
                  <button type="reset" class="btn btn-secondary">Cancella</button>
                  <button type="submit" class="btn btn-success">Salva post</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection