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
                </div>
                <div class="card-footer d-flex">
                    <div class=" ms-auto">
                        ciao
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
