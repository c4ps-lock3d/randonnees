@extends('base')

@section('title', 'Bienvenue')

@section('content')   
    <h1></h1>
    <div class="row">
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div style="text-align:center" class="card-body">
                    <p class="card-text mb-0">Nombre de randonnées enregistrées</p>
                    <p style="font-size:28px" class="card-text">{{$count_posts}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div style="text-align:center" class="card-body">
                    <p class="card-text mb-0">Distance totale parcourue</p>
                    <p style="font-size:28px" class="card-text">{{round($sum_distance,0)}} km</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div style="text-align:center" class="card-body">
                    <p class="card-text mb-0">Région préférée</p>
                    <p style="font-size:28px" class="card-text">@foreach($fav_areas as $fav_area){{$fav_area->name}}@endforeach</p>
                </div>
            </div>
        </div>
    </div>

    <h1>Dernières randonnées</h1>
    <div class="row">
        @foreach($last_posts as $postgpx)
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
            @if($postgpx->image)
                    <img src="{{ $postgpx->image }}" width="400" height="200" class="card-img-top" alt="...">
                @else
                    <img src="{{url('img/9121424.jpg')}}" width="400" height="200" class="card-img-top" alt="...">
                @endif
                <div class='card-img-overlay'>
                <div class='float-left'>
                    <div>
                        <h6 id='newsDate' class='card-text'><small>{{$postgpx->date}} - {{$postgpx->cat_area->name}}</small></h6>
                    </div>
                </div>
                </div>
                <div class="card-body pb-1">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row">
                    <div class="col-6 pb-4">
                    <p class="card-text">
                        <i class="fas fa-long-arrow-alt-right"></i>&nbsp;&nbsp;{{$postgpx->distance}} km
                    </p>
                    <p class="card-text">
                        <i class="fas fa-caret-up"></i>&nbsp;&nbsp;{{$postgpx->eleAsc}} m
                    </p>
                    </div>
                    <div class="col-6 pb-4">
                    <p class="card-text">
                        <i class="far fa-clock"></i>&nbsp;&nbsp;{{$postgpx->duration}}
                    </p>
                    <p class="card-text">
                        <i class="fas fa-caret-down"></i>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
                    </p>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                @if(!$postgpx->tags->isEmpty())
                                    @foreach($postgpx->tags as $tag)
                                        <span class="badge bg-secondary text-light">{{$tag->name}}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div>
                                @if($postgpx->cat_difficulty_id == 1)
                                    <span><img src="{{url('img/icon-wanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 2)
                                    <span><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 3)
                                    <span><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 4)
                                    <span><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 5)
                                    <span><img src="{{url('img/icon-alpinwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    <div>
@endsection