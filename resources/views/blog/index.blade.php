@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
<div class="row">
    <div class="col-12 pt-4 pb-4">
        <div class="card h-100 text-light bg-dark">
                <div class="card-header d-flex justify-content-between">
                    <div>Filtres</div> 
                </div>
                <div class="card-body">
                    <form class="" action="" method="get">
                        <div class="row">
                            <div class="btn-group btn-group-sm col-sm pb-1 pr-2 pl-2" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tag</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach($tags as $tag)
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" name="{{$tag->name}}" type="checkbox" id="{{$tag->name}}" @if(request()->{$tag->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <div class="form-check dropdown-item">
                                        <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm col-sm pb-1 pr-2 pl-2" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Région</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach($cat_areas as $cat_area)
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" name="{{$cat_area->name}}" type="checkbox" id="{{$cat_area->name}}" @if(request()->{$cat_area->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_area->name}}">{{$cat_area->name}}</label>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <div class="form-check dropdown-item">
                                        <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm col-sm pb-1 pr-2 pl-2" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Difficultée</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach($cat_difficulties as $cat_difficulty)
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" name="{{$cat_difficulty->name}}" type="checkbox" id="{{$cat_difficulty->name}}" @if(request()->{$cat_difficulty->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_difficulty->name}}">{{$cat_difficulty->name}}</label>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <div class="form-check dropdown-item">
                                        <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm col-sm pb-1 pr-2 pl-2 role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Difficulté chien</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach($cat_dogfriendlies as $cat_dogfriendly)
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" name="{{$cat_dogfriendly->name}}" type="checkbox" id="{{$cat_dogfriendly->name}}" @if(request()->{$cat_dogfriendly->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_dogfriendly->name}}">{{$cat_dogfriendly->name}}</label>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <div class="form-check dropdown-item">
                                        <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm col-sm pb-1 pr-2 pl-2" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tracé</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach($cat_layouts as $cat_layout)
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" name="{{$cat_layout->name}}" type="checkbox" id="{{$cat_layout->name}}" @if(request()->{$cat_layout->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_layout->name}}">{{$cat_layout->name}}</label>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <div class="form-check dropdown-item">
                                        <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                    </div>
                                </div>
                            </div>
                            <a class="btn-group btn-group-sm col-sm-2 pb-1 pr-2 pl-2" href="{{ route('blog.index') }}" style="text-decoration:none"><button class="btn btn-sm btn-secondary" type="button" name="submit"><i class="fas fa-eraser"></i>&nbsp;&nbsp;Réinitialiser</button></a>
                        </div>
                        <!-- <input class="form-check-input" name="tagSommet" type="checkbox" id="tagSommet" value="tagSommet" onchange="document.getElementById('filter').submit()" @if(request()->tagSommet) checked @endif> -->                      
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
        <div class="dropdown">
            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none">Trier par</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <input type="submit" name="triDateDesc" id="triDateDesc" class="dropdown-item" href="#" value="Date décroissante"></input>
                <input type="submit" name="triDateAsc" id="triDateAsc" class="dropdown-item" href="#" value="Date croissante"></input>
                <input type="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#" value="Difficultée décroissante"></input>
                <input type="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#" value="Difficultée croissante"></input>
                <input type="submit" name="triDurationDesc" id="triDurationDesc" class="dropdown-item" href="#" value="Durée décroissante"></input>
                <input type="submit" name="triDurationAsc" id="triDurationAsc" class="dropdown-item" href="#" value="Durée croissante"></input>
            </div>
        </div>
        <div>{{$count_posts}}/{{$count_total_posts}} affichées</div>
        </div>
        <!-- <div class="form-check form-check-inline">
        <input class="form-check-input" type="submit" name="triDateDesc" id="inlineRadio1" value="option1">
        <label class="form-check-label" for="inlineRadio1">Plus récent en premier</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="submit" name="triDateAsc" id="inlineRadio2" value="option2">
        <label class="form-check-label" for="inlineRadio2">Plus ancien en premier</label>
        </div>
        <button class="btn btn-sm btn-dark" type="submit" name="submit"><i class="fas fa-sort"></i>&nbsp;&nbsp;Trier</button> -->

        <hr class="mb-3 mt-2">

            </form>


    <div class="row">
        @foreach($gpxes as $postgpx)
        <div class="col-xl-4 col-lg-6 col-md-6 pb-4">
            <div class="card h-100 text-light bg-dark shadow-lg">
                <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
                    @if($postgpx->image)
                        <img src="storage/{{ $postgpx->image }}" width="400" height="200" class="card-img-top" alt="...">
                    @else
                        <img src="{{url('img/9121424.jpg')}}" width="400" height="200" class="card-img-top" alt="...">
                    @endif
                    <div class='card-img-overlay'>
                    <div class='float-left'>
                        <div>
                            <h6 id='newsDate' class='card-text'><small>{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->cat_area->name}}</small></h6>
                        </div>
                    </div>
                    </div>
                    <div class="card-body pb-1">
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
                                    <i class="far fa-clock"></i>&nbsp;&nbsp;{{date("H:i", strtotime($postgpx->duration))}}
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
