@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
<div class="row">
    <div class="col-12 pt-4">
        <div class="card h-100 text-dark bg-light shadow-lg">
            <div class="card-header">Filtres</div>
            <div class="card-body">
                <form class="" action="" method="get">
                    <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tag</button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($tags as $tag)
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input" name="{{$tag->name}}" type="checkbox" @if(request()->{$tag->name}) checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">{{$tag->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Région</button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_areas as $cat_area)
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input" name="{{$cat_area->name}}" type="checkbox" @if(request()->{$cat_area->name}) checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">{{$cat_area->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Difficultée</button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_difficulties as $cat_difficulty)
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input" name="{{$cat_difficulty->name}}" type="checkbox" @if(request()->{$cat_difficulty->name}) checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">{{$cat_difficulty->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Difficulté chien</button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_dogfriendlies as $cat_dogfriendly)
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input" name="{{$cat_dogfriendly->name}}" type="checkbox" @if(request()->{$cat_dogfriendly->name}) checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">{{$cat_dogfriendly->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tracé</button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_layouts as $cat_layout)
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input" name="{{$cat_layout->name}}" type="checkbox" @if(request()->{$cat_layout->name}) checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">{{$cat_layout->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="triDateDesc">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Plus récent en premier
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="triDateAsc">
                            <label class="form-check-label" for="flexRadioDefault2">    
                                Plus ancien en premier
                            </label>
                        </div>

                        <!-- <input class="form-check-input" name="tagSommet" type="checkbox" id="tagSommet" value="tagSommet" onchange="document.getElementById('filter').submit()" @if(request()->tagSommet) checked @endif> -->                      
                    <button class="btn btn-sm btn-dark" type="submit" name="submit"><i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                    <a href="{{ route('blog.index') }}"><button class="btn btn-sm btn-dark" type="button" name="submit"><i class="fas fa-eraser"></i>&nbsp;&nbsp;Réinitialiser</button></a>
                    <button class="ml-4 btn btn-sm btn-outline-dark" disabled type="button">Affiché : {{$count_posts}} randonnées sur {{$count_total_posts}}</button>

            </div>

        </div>
    </div>
</div>

</form>
    <!-- <form action="" method="get">
    <div class="dropdown">
        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none">Tri</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a type ="submit" name="triDateDesc" id="triDateDesc" class="dropdown-item" href="#">récent > ancien</a>
            <a type ="submit" name="triDateAsc" id="triDateAsc" class="dropdown-item" href="#">ancien > récent</a>
            <a type ="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#">exigant > facile</a>
            <a type ="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#">facile > exigant</a>
        </div>
    </div>
    </form><hr> -->

    <div class="row">
        @foreach($gpxes as $postgpx)
        <div class="col-xl-4 col-lg-6 col-md-6 pb-4 pt-4">
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