@extends('base')

@section('title', 'Toutes nos randonnées')

@section('content')
<div class="row">
    <div class="col-12 pt-4 pb-4">
        <div class="card h-100 text-light bg-dark">
            <div class="card-header d-flex justify-content-between">
                <div>Filtres</div>
                <div>{{$count_posts}} de {{$count_total_posts}} affichées</div>
            </div>             
            <div class="card-body">
                <form class="" action="" method="get">
                    <div class="row">
                        <div class="dropdown btn-group btn-group-sm col-sm pb-1" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">Tag</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($tags as $tag)
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" name="{{$tag->name}}" type="checkbox" id="{{$tag->name}}" @if(request()->{$tag->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="form-check dropdown-item">
                                    <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                </div>
                            </ul>
                        </div>
                        <div class="dropdown btn-group btn-group-sm col-sm pb-1" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">Canton</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($list_areas as $list_area)
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" name="{{$list_area}}" type="checkbox" id="{{$list_area}}" @if(request()->{$list_area}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$list_area}}">{{$list_area}}</label>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="form-check dropdown-item">
                                    <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                </div>
                            </ul>
                        </div>
                        <div class="dropdown btn-group btn-group-sm col-sm pb-1" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">Difficultée</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_difficulties as $cat_difficulty)
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" name="{{$cat_difficulty->name}}" type="checkbox" id="{{$cat_difficulty->name}}" @if(request()->{$cat_difficulty->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_difficulty->name}}">{{$cat_difficulty->name}}</label>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="form-check dropdown-item">
                                    <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown btn-group btn-group-sm col-sm pb-1" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">Difficulté chien</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_dogfriendlies as $cat_dogfriendly)
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" name="{{$cat_dogfriendly->name}}" type="checkbox" id="{{$cat_dogfriendly->name}}" @if(request()->{$cat_dogfriendly->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_dogfriendly->name}}">{{$cat_dogfriendly->name}}</label>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="form-check dropdown-item">
                                    <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown btn-group btn-group-sm col-sm pb-1" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">Tracé</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @foreach($cat_layouts as $cat_layout)
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" name="{{$cat_layout->name}}" type="checkbox" id="{{$cat_layout->name}}" @if(request()->{$cat_layout->name}) checked @endif>
                                            <label style="width:100%" class="form-check-label" for="{{$cat_layout->name}}">{{$cat_layout->name}}</label>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="form-check dropdown-item">
                                    <button style="font-weight: bold;background: none;color: black;border: none;font-size:17px;cursor: pointer;outline: inherit;" name="submit">  <i class="fas fa-search"></i>&nbsp;&nbsp;Rechercher</button>
                                </div>
                            </div>
                        </div>
                        <a class="btn-group btn-group-sm col-sm-2 pb-1" href="{{ route('blog.index') }}" style="text-decoration:none"><button class="btn btn-sm btn-secondary" type="button" name="submit"><i class="fas fa-eraser"></i>&nbsp;&nbsp;Réinitialiser</button></a>
                    </div>
                    <!-- <input class="form-check-input" name="tagSommet" type="checkbox" id="tagSommet" value="tagSommet" onchange="document.getElementById('filter').submit()" @if(request()->tagSommet) checked @endif> -->                      
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="dropdown">
            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none">Trier par</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <input type="submit" name="triDateDesc" id="triDateDesc" class="dropdown-item" href="#" value="Plus récent en premier"></input>
                <input type="submit" name="triDateAsc" id="triDateAsc" class="dropdown-item" href="#" value="Plus ancien en premier"></input>
                <input type="submit" name="triDistEffDesc" id="triDistEffDesc" class="dropdown-item" href="#" value="Plus difficile en premier"></input>
                <input type="submit" name="triDistEffAsc" id="triDistEffAsc" class="dropdown-item" href="#" value="Plus facile en premier"></input>
                <input type="submit" name="triDurationDesc" id="triDurationDesc" class="dropdown-item" href="#" value="Plus long en premier"></input>
                <input type="submit" name="triDurationAsc" id="triDurationAsc" class="dropdown-item" href="#" value="Plus court en premier"></input>
            </div>
        </div>
        <button style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;" class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <span class="if-collapsed mdi mdi-map">&nbsp;&nbsp;Afficher la carte</span>
            <span class="if-not-collapsed mdi mdi-map">&nbsp;&nbsp;Masquer la carte</span>
        </button>
    </div>
    <hr class="mb-3 mt-2">
    </form>


<div class="collapse show" id="collapseExample">
  <div class="col-xxl-12 col-lg-12 col-md-12 pb-4">
    <div class="card h-100 text-light bg-dark shadow-lg">
      <div class="card-img-top card-img-bottom" id="map"></div>
    </div>  
  </div>
</div>

    <div class="row">
        @foreach($gpxes as $postgpx)
        <div class="col-xxl-3 col-lg-4 col-md-6 pb-4">
            <div class="card h-100 text-light bg-dark box-shadow">
                <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
                    @if($postgpx->image)
                        <img src="storage/{{ $postgpx->image }}" height="200" class="card-img-top" alt="..." style="object-fit:cover">
                    @else
                        <img src="{{url('img/9121424.webp')}}" height="200" class="card-img-top" alt="..." style="object-fit:cover">
                    @endif
                    <div class='card-img-overlay'>               
                        <div class='bg-dark' style='font-size:14px' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
                    </div>
                    <div class="card-body pb-1">
                        <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                        <div class="row pt-3">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                  <p class="card-text">
                                    @if($postgpx->cat_layout_id == 1)
                                    <span class="mdi mdi-refresh"></span>
                                    @endif
                                    @if($postgpx->cat_layout_id == 2)
                                    <span class="mdi mdi-arrow-left-right"></span>
                                    @endif
                                    @if($postgpx->cat_layout_id == 3)
                                    <span class="mdi mdi-arrow-right"></span>
                                    @endif
                                    &nbsp;&nbsp;{{$postgpx->distance}} km ({{$postgpx->distEff}} km-effort)
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", ceil(strtotime($postgpx->duration)/300)*300)}}
                                  </p>
                                  </div>
                              </div>
                              </div>
                            <div class="row pt-3 pb-3">
                            <div class="d-flex justify-content-between">
                            <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-top-right"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-bottom-right"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
                                  </p>
                                </div>
                                <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-collapse-up"></span>&nbsp;&nbsp;{{$postgpx->eleMax}} m
                                  </p>
                              </div>
                              </div>
                          </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span style="margin-right:8px" class="mdi mdi-tag"></span>
                                @if(!$postgpx->tags->isEmpty())
                                    @foreach($postgpx->tags as $tag)
                                        <span class="badge bg-secondary text-light">{{$tag->name}}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div>
                                @if($postgpx->cat_difficulty_id == 1)
                                <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-wanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
                                <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 2)
                                <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
                                <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 3)
                                <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
                                <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 4)
                                <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-alpinwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
                                <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                                @if($postgpx->cat_difficulty_id == 5)
                                <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-alpinwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
                                <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    <div>

    <script>
    var pinIcon = L.icon({
        iconUrl: 'img/leafset-pin.png',
        //shadowUrl: 'leaf-shadow.png',

        iconSize:     [40, 40], // size of the icon
        //shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [20, 40], // point of the icon which will correspond to marker's location
        //shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
    });
  const mapDiv = document.getElementById("map");

  var urlPixelkarteGrau = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-grau/default/current/3857/{z}/{x}/{y}.jpeg');
  var urlPixelkarteFarbe = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-farbe/default/current/3857/{z}/{x}/{y}.jpeg');
  var urlSwissimage = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.swissimage/default/current/3857/{z}/{x}/{y}.jpeg');
  var map = new L.Map('map', {
    crs: L.CRS.EPSG3857,
    continuousWorld: true,
    worldCopyJump: false,
    attributionControl: false,
    layers: [urlPixelkarteGrau],
    minZoom: 8,
    zoomControl: false
  });
  
  var baseMaps = {
    "Satelite": urlSwissimage,
    "Carte nationale (couleur)": urlPixelkarteFarbe,
    "Carte nationale (gris)": urlPixelkarteGrau,
  };
  var layerControl = L.control.layers(baseMaps).addTo(map);
  L.control.scale({
    imperial: false,
  }).addTo(map);
  L.control.zoom({
    position: 'bottomright'
}).addTo(map);
  
  map.setView(L.latLng(46.800663464, 8.222665776),  8);
  var gpxes = <?php echo json_encode($gpxes, JSON_HEX_TAG); ?>;

  gpxes.forEach(element => {
    var marker = L.marker([element.latstart, element.lonstart],{icon: pinIcon}).addTo(map);
    marker.bindPopup('<a style="color:#000" href=https://randos.top/randonnees/'+element.slug+'-'+element.id+'>'+element.title+'</a>');
    marker.on('mouseover',function(ev) {
  marker.openPopup();
});
    //var marker = L.marker([element.latstart, element.lonstart],{icon: pinIcon}).addTo(map).bindPopup('<a style="color:#000" href=https://randos.top/randonnees/'+element.slug+'-'+element.id+'>'+element.title+'</a>');

  });

  
  
  map.setMaxBounds(map.getBounds());

  const resizeObserver = new ResizeObserver(() => {map.invalidateSize();});
  resizeObserver.observe(mapDiv);
</script>
@endsection
