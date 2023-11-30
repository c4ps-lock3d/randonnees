@extends('base')

@section('title', 'Nos randonnées')

@section('content')
    <h1>Nos randonnées</h1>
    {{--<a href="{{ route('blog.indexTriDistance')}}"><button style="width:80px" class="btn btn-dark">Distance</button></a>--}}
    <div class="row">
        @foreach($posts as $post)
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">
                <img src="https://www.appartementcourchevel.com/wp-content/uploads/2022/06/montagne.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">
                        {{$post->eleAsc}} m
                    </p>
                    <p class="card-text">
                        {{$post->distance}} km
                    </p>
                </div>
                <div class="card-footer">
                    {{$post->date}}
                </div>
                </a>
            </div>
        </div>
        @endforeach
    <div>
@endsection