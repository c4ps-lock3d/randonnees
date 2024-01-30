@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
    <h1 style="display:flex">
    <form style="margin-left:auto" action="" method="get">
        <div class="btn-group btn-group-sm" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tri
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                <button type ="submit" name="triDateDesc" id="triDateDesc" class="dropdown-item" href="#">récent > ancien</button>
                <button type ="submit" name="triDateAsc" id="triDateAsc" class="dropdown-item" href="#">ancien > récent</button>
                <button type ="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#">exigant > facile</button>
                <button type ="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#">facile > exigant</button>
            </div>
        </div>
    </form></h1>

    <!--<form action="" method="get">
        <button type ="submit" name="tagCol" id="tagCol" class="btn btn-outline-secondary" href="#">Col</button>
    </form>-->

    <div class="row">
        @foreach($gpxes as $postgpx)
        <div class="col-xl-4 col-lg-6 col-md-6 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
                <img src="https://www.appartementcourchevel.com/wp-content/uploads/2022/06/montagne.jpg" class="card-img-top" alt="...">
                <div class='card-img-overlay'>
                <div class='float-left'>
                    <div>
                        <h6 id='newsDate' class='card-text'><small>{{$postgpx->date}} - {{$postgpx->cat_area->name}}</small></h6>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row">
                    <div class="col-6">
                    <p class="card-text">
                        <i class="fas fa-long-arrow-alt-right"></i>&nbsp;&nbsp;{{$postgpx->distance}} km
                    </p>
                    <p class="card-text">
                        <i class="fas fa-caret-up"></i>&nbsp;&nbsp;{{$postgpx->eleAsc}} m
                    </p>
                    </div>
                    <div class="col-6 pb-3">
                    <p class="card-text">
                        <i class="far fa-clock"></i>&nbsp;&nbsp;{{$postgpx->duration}}
                    </p>
                    <p class="card-text">
                        <i class="fas fa-caret-down"></i>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
                    </p>
                    </div>
                    </div>
                    @if(!$postgpx->tags->isEmpty())
                        @foreach($postgpx->tags as $tag)
                            <span class="badge bg-secondary text-light">{{$tag->name}}</span>
                        @endforeach
                    @endif
                </div>
                </a>
            </div>
        </div>
        @endforeach
    <div>
@endsection