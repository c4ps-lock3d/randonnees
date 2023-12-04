@extends('base')

@section('title', 'Bienvenue')

@section('content')
    
    <h1>Statistiques</h1>
    <div class="row">
        <div class="col-lg-6 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div class="card-body">
                    <p class="card-text">Nombre de randonnées enregistrées : {{$count_posts}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div class="card-body">
                    <p class="card-text">Distance totale parcourue : {{round($sum_distance,0)}} km</p>
                </div>
            </div>
        </div>
    </div>

    <h1>Dernières randonnées</h1>
    <div class="row">
        @foreach($last_posts as $post)
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