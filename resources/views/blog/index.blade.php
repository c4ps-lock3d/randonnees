@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
    <h1>Nos randonnées
    <form action="" method="get">
        <div class="btn-group btn-group-sm" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tri
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <button type ="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#">Distance effort (plus grand au plus petit)</button>
                <button type ="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#">Distance effort (plus petit au plus grand)</button>
            </div>
        </div>
    </form></h1>

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