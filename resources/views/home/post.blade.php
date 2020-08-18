@extends('master')


@push('css')
    <link href="css/home.css" rel="stylesheet">
@endpush
@section('content')

    <a href="logout" style="float: right; margin: 10px"> Cerrar Sesi&oacute;n</a> <a href="home" style="float: right; margin: 10px"> Home</a>

    <h1> {{ $post->title }} </h1>
    <h4>by {{ $post->autor->name }} - {{ $post->created_at }}</h4>
    <div>
    </div>
    {!! $post->content !!}

    @foreach ($post->comments as $comment)
        <blockquote>
            <p class="comment-user"> <span class="name-user">{{ $comment->user->name }}</span> {{ $comment->content }}</p>
            <footer>
                <cite title="Source Title">{{ $comment->created_at }}</cite>
            </footer>
        </blockquote>
    @endforeach

    @error('error')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('comentario')
    <div class="alert alert-danger">Escriba un comentario</div>
    @enderror

    @if ($hasPost)
        <h3>Dejenos su comentario </h3>
        <form class="form-signin" method="get" action="add/comment">
            @csrf
            <textarea class="form-control" rows="3" name="comentario" placeholder="Dejenos su comentario"></textarea>
            <input type="hidden" value="{{ $post->id }}" name="id" class="form-control" rows="3" name="comentario"
                placeholder="Dejenos su comentario" required>
            <br>
            <button class="btn btn-lg btn-primary " type="submit">Comentar</button>
        </form>
    @endif

@endsection
