@extends('base')

@section('title', $postgpx->title)

@section('content')

@auth
<a href="{{ route('blog.edit', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
<div class="row">
  <div class="col-xxl-4 col-lg-4 col-md-12 mt-4">
    <div class="card h-100 text-light bg-dark shadow-lg">
      @if($postgpx->image)
        <img src="../storage/{{ $postgpx->image }}" height="250" class="card-img-top" alt="..." style="object-fit:cover">
      @else
        <img src="{{url('img/9121424.webp')}}" height="250" class="card-img-top" alt="..." style="object-fit:cover">
      @endif
      <div class='card-img-overlay'>               
        <div class='bg-dark' style='font-size:14px' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
      </div>
      <div class="card-body">
        <h4 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h4>
        <div class="row pt-4">
          <div class="col-9">
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
          <div class="col-3">
            <p class="card-text">
              <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", ceil(strtotime($postgpx->duration)/300)*300)}}
            </p>
          </div>
        </div>
        <div class="row pt-3">
          <div class="col-4">
            <p class="card-text">
              <span class="mdi mdi-arrow-top-right"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
            </p>
          </div>
          <div class="col-5">
            <p class="card-text">
              <span class="mdi mdi-arrow-bottom-right"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
            </p>
          </div>
          <div class="col-3">
            <p class="card-text">
              <span class="mdi mdi-arrow-collapse-up"></span>&nbsp;&nbsp;{{$postgpx->eleMax}} m
            </p>
          </div>
        </div>
        <canvas class="pt-3" id="myChart"></canvas>
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
            @if($postgpx->cat_dogfriendly_id == 1)
              <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-right:8px;padding-left:12px" class="mdi mdi-dog-side"></span>
              <span style="margin-right:12px" class="badge bg-secondary text-light">{{$postgpx->cat_dogfriendly->name}}</span>
            @endif
            @if($postgpx->cat_dogfriendly_id == 2)
              <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-right:8px;padding-left:12px" class="mdi mdi-dog-side"></span>
              <span style="margin-right:12px" class="badge bg-secondary text-light">{{$postgpx->cat_dogfriendly->name}}</span>
            @endif
            @if($postgpx->cat_dogfriendly_id == 3)
              <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-right:8px;padding-left:12px" class="mdi mdi-dog-side"></span>
              <span style="margin-right:12px" class="badge bg-secondary text-light">{{$postgpx->cat_dogfriendly->name}}</span>
            @endif
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
              <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-bergwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
              <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
            @endif
            @if($postgpx->cat_difficulty_id == 5)
              <span style="border-left: 1px solid #24313C;padding-top:10px;padding-bottom:12px;padding-left:12px"><img src="{{url('img/icon-alpinwanderung.svg')}}" style="margin-bottom:3px" width="20px" height="20px">&nbsp;&nbsp;</span>
              <span class="badge bg-secondary text-light">{{$postgpx->cat_difficulty->name}}</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xxl-8 col-lg-8 col-md-12 mt-4">
    <div class="card h-100 text-light bg-dark shadow-lg">
      <div class="card-img-top" id="map" style="height:610px"></div>
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <a href="{{ route('blog.download', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}"><button class="btn btn-sm btn-secondary" type="submit" style="height:2.4em;font-size:11px"><i class="fas fa-download"></i>&nbsp;&nbsp;Télécharger GPX</button></a>
          </div>
        </div>
    </div>  
  </div>

<script>
  var urlPixelkarteGrau = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-grau/default/current/3857/{z}/{x}/{y}.jpeg');
  var urlPixelkarteFarbe = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-farbe/default/current/3857/{z}/{x}/{y}.jpeg');
  var urlSwissimage = L.tileLayer('https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.swissimage/default/current/3857/{z}/{x}/{y}.jpeg');
  var map = new L.Map('map', {
    crs: L.CRS.EPSG3857,
    continuousWorld: true,
    worldCopyJump: false,
    attributionControl: false,
    layers: [urlSwissimage]
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
  var mapLat = <?php echo json_encode($mapLat, JSON_HEX_TAG); ?>;
  var mapLon = <?php echo json_encode($mapLon, JSON_HEX_TAG); ?>;
  let lengthLatLon = mapLat.length;
 
  map.setView(L.latLng(mapLat[1], mapLon[1]), 8);
  var marker = L.marker([mapLat[1], mapLon[1]]).addTo(map);
  
  const latlngs = [];
  for (let i = 0; i < lengthLatLon; i++) {
    latlngs.push([mapLat[i], mapLon[i]]);
  }
  // create a red polyline from an array of LatLng points
  var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
  map.fitBounds(polyline.getBounds());
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  
  var chartDis = <?php echo json_encode($chartDis, JSON_HEX_TAG); ?>;
  var chartEle = <?php echo json_encode($chartEle, JSON_HEX_TAG); ?>;
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartDis,
      display: true,
      datasets: [{
        label: '',
        data: chartEle,
        borderWidth: 0,
        fill: true,
        pointStyle: 'circle',
        pointRadius: 1,
        pointHoverRadius: 15,
      }]
    },
    options: {
      scales: { 
        x: {
          display: true,
          ticks: {
            color: '#90b6db',
              autoSkip: true,
              maxTicksLimit: 12,
              stepSize: .5
          },
          title: {
            display: false,
            text: 'Distance',
            color: '#90b6db',
          },
          grid: {
            color: '#4f667d',
          },
        },
        y: {
          beginAtZero: false,
          display: true,
          ticks: {
            stepSize: 50,
            color: '#90b6db',
          },
          title: {
            display: false,
            text: 'Altitude',
            color: '#90b6db',
          },
          grid: {
            color: '#4f667d',
          }
        },
      },
      plugins: {
        legend: {
          display: false,
          labels: {
            color: '#90b6db',
          },
        },
      },
    }
  });
</script>

@endsection