@extends('base')

@section('title', $postgpx->title)

@section('content')
@auth
<a href="{{ route('blog.edit', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
    <article>
        <h1>{{$postgpx->title}}</h1>
        <p>Date : {{$postgpx->date}}</p>
        <p>Région : {{$postgpx->cat_area->name}}</p>
        <p>Type de parcours : {{$postgpx->layout}}</p>
        <p>Type de randonnée : {{$postgpx->topography}}</p>
        <p>Distance : {{$postgpx->distance}} km</p>
        <p>Distance effort : {{$postgpx->distEff}} km</p>
        <p>Dénivelé positif : {{$postgpx->eleAsc}} m</p>
        <p>Dénivelé négatif : {{$postgpx->eleDsc}} m</p>
        <p>Altitude de départ : {{$postgpx->eleStart}} m</p>
        <p>Altitude maximale : {{$postgpx->eleMax}} m</p>
        <p>Durée : {{$postgpx->duration}}</p>
        <p>Difficulté : {{$postgpx->difficulty}}</p>
        <p>Lien Google Maps : <a href='{{$postgpx->google}}' target="_blank">{{$postgpx->google}}</a></p>
        @if (empty($postgpx->hut))
        @else
            <p>Cabane : {{$postgpx->hut}}</p>
        @endif
        <p>Accessibilité pour les toutous : {{$postgpx->dogFriendly}}</p>
        <p>Remarques : {{$postgpx->comments}}</p>
    </article>
@endsection