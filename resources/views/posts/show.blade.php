@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>
                    <div class="card-header">{{ $post->name }}</div>


                    <div class="card-body">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3" alt="blog post">

                        <p>{{ $post->body }}</p>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>Опубликовано {{ $post->created_at->format('M d, Y') }}</div>
                            <div>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="my-5">
                    <h3 class="text-center mb-4">Комментарии</h3>

                    @foreach($post->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-header">{{ $comment->name }}</div>
                            <div class="card-body">{{ $comment->text }}</div>
                            @if(isset($comment->commentImage))
                            <div class="card-body">
                            <img src="{{ asset('storage/' . $comment->commentImage) }}" width="200" class="img-fluid mb-3">
                            </div>
                            @endif
@auth
                            @if( Auth::user()->name == $comment->name)



                                <div class="card-footer">
                                <div class="d-flex justify-content-end">

                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}"  class="d-inline-block" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                                @endauth
                            @endif
                        </div>

                    @endforeach

                    @auth
                    <form method="POST" action="{{ route('comments.store', $post) }}"  enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="text">Комментарий</label>
                            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <div class="btn-primary">
                                <input type="file" id="image" name="commentImage">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                        @endauth
                </div>
            </div>
        </div>
    </div>


@endsection


