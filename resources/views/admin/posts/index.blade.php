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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h3>{{$post->title}} </h3>
                                <p>Autore: {{ $post->author }}</p>
                            </div>
                            <div class="d-flex">
                                @include('partials.destroybtn')
                                @include('partials.updatebtn')
                                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary">Leggi</a>
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