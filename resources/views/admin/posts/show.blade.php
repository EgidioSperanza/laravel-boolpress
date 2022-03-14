@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $post->title }}
                </div>
                <div class="card-body">
                    Autore: {{ Auth::user()->name }}
                    <p>{{ $post->content }}</p>
                    <div class="small text-end">
                        @if($post->created_at==$post->updated_at)
                            Pubblicato il {{$post->created_at->format('d-m-Y')}}
                            @else
                            Modificato il {{$post->updated_at->format('d-m-Y')}}
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <div class=" ms-auto">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary me-2">Indietro</a>
                        @include('partials.destroybtn')
                        @include('partials.updatebtn')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
