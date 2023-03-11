@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Post</h1>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="body">Текст поста</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" required>{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <div class="btn-primary">
                    <input type="file" id="image" name="image">

                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
