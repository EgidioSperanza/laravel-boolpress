@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
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

              {{-- contenuto del post --}}
              <div class="mb-3">
                <label>Contenuto</label>
                <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                  placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                @error('content')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
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