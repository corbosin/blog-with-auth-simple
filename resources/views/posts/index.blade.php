@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4">Бложик</h1>
            @auth
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Создать новый пост</a>
            @endauth
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        <div class="card-header"><i>Автор: {{ $post->name }}</i></div>
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="blog post">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Читать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
