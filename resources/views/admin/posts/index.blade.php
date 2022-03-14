@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Posts
                    <a href="{{route('admin.posts.create')}}" class="nav-link ms-auto">
                        Nuovo Post <i class="bi bi-plus-square-fill"></i>
                    </a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ( $posts as $post )
                        <li class="list-group-item d-flex justify-content-between">
                            {{$post->title}} 
                            <div>
                                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary">Leggi</a>
                            </div>
                        </li>
                        @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection