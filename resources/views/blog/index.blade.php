@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
    <h1 style="display:flex">Nos randonnées
    <form style="margin-left: auto;" action="" method="get">
        <div class="btn-group btn-group-sm" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tri
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                <button type ="submit" name="triDateDesc" id="triDateDesc" class="dropdown-item" href="#">Du plus récent au plus ancien (défaut)</button>
                <button type ="submit" name="triDateAsc" id="triDateAsc" class="dropdown-item" href="#">Du plus ancien au plus récent</button>
                <button type ="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#">Du plus exigant au plus facile</button>
                <button type ="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#">Du plus facile au plus exigant</button>
            </div>
        </div>
    </form></h1>

    <div class="row">
        @foreach($posts as $post)
        <div class="col-xl-4 col-lg-6 col-md-6 pb-4">
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