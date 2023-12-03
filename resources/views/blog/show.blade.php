@extends('base')

@section('title', $post->title)

@section('content')
@auth
<a href="{{ route('blog.edit', ['slug' => $post->slug, 'post' => $post->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
    <article>
        <h1>{{$post->title}}</h1>
        <p>Date : {{$post->date}}</p>
        <!--<p>Région : {{$post->area}}</p>
        <p>Type de parcours : {{$post->layout}}</p>
        <p>Type de randonnée : {{$post->topography}}</p>-->
        <p>Distance : {{$post->distance}} km</p>
        <p>Distance effort : {{$post->distEff}} km</p>
        <p>Dénivelé positif : {{$post->eleAsc}} m</p>
        <p>Dénivelé négatif : {{$post->eleDsc}} m</p>
        <p>Altitude de départ : {{$post->eleStart}} m</p>
        <p>Altitude maximale : {{$post->eleMax}} m</p>
        <p>Durée : {{substr($post->duration,0,-3)}}</p>
        <!--<p>Difficulté : {{$post->difficulty}}</p>-->
        <p>Lien Google Maps : <a href='{{$post->google}}' target="_blank">{{$post->google}}</a></p>
        @if (empty($post->hut))
        @else
            <p>Cabane : {{$post->hut}}</p>
        @endif
        <!--<p>Accessibilité pour les toutous : {{$post->dogFriendly}}</p>-->
        <p>Remarques : {{$post->comments}}</p>
    </article>
@endsection