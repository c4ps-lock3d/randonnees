@extends('base')

@section('title', $postgpx->title)

@section('content')
@auth
<a href="{{ route('blog.edit', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
<h1>{{$postgpx->title}}</h1>
<div class="row">
  <div class="col-lg-6 col-md-12">
          <p>Date : {{date("d.m.Y", strtotime($postgpx->date))}}
          Région : {{$postgpx->cat_area->name}}
          Type de parcours : {{$postgpx->cat_layout->name}}
          Type de randonnée :
            @foreach($postgpx->tags as $tag)
              <span class="badge bg-secondary text-light">
                {{$tag->name}}
              </span>
            @endforeach
          
          Distance : {{$postgpx->distance}} km
          Distance effort : {{$postgpx->distEff}} km
          Dénivelé positif : {{$postgpx->eleAsc}} m
          Dénivelé négatif : {{$postgpx->eleDsc}} m
          Altitude de départ : {{$postgpx->eleStart}} m
          Altitude maximale : {{$postgpx->eleMax}} m
          Durée : {{date("H:i", strtotime($postgpx->duration))}}
          Difficulté : {{$postgpx->cat_difficulty->name}}
          Difficultée pour les toutous : {{$postgpx->cat_dogFriendly->name}}
          @if (empty($postgpx->google))
          @else
            Lien Google Maps : <a href='{{$postgpx->google}}' target="_blank">{{$postgpx->google}}</a>
          @endif
          @if (empty($postgpx->hut))
          @else
            Cabane : {{$postgpx->hut}}
          @endif
          @if (empty($postgpx->comments))
          @else
            Remarques : {{$postgpx->comments}}</p>
          @endif  
  </div>
  <div class="col-lg-6 col-md-12">
    <canvas id="myChart"></canvas>
  </div>
  <div class="col-lg-12 col-md-12">
    <div id="map" style="height: 350px"></div>
  </div>
  
</div>
<script>
  var map = new L.Map('map', {
    crs: L.CRS.EPSG3857,
    continuousWorld: true,
    worldCopyJump: false,
    attributionControl: false,
  });

  var url = 'https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-farbe/default/current/3857/{z}/{x}/{y}.jpeg';
  var tilelayer = new L.tileLayer(url);
  var mapLat = <?php echo json_encode($mapLat, JSON_HEX_TAG); ?>;
  var mapLon = <?php echo json_encode($mapLon, JSON_HEX_TAG); ?>;
  let lengthLatLon = mapLat.length;
  map.addLayer(tilelayer);
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
        label: 'Altitude',
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
            display: true,
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
            display: true,
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