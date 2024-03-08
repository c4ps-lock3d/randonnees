@extends('base')

@section('title', $postgpx->title)

@section('content')
@auth
<a href="{{ route('blog.edit', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
<h1>{{$postgpx->title}}</h1>
<div class="row">
  <div class="col-6">
          <p>Date : {{date("d.m.Y", strtotime($postgpx->date))}}</p>
          <p>Région : {{$postgpx->cat_area->name}}</p>
          <p>Type de parcours : {{$postgpx->cat_layout->name}}</p>
          <p>Type de randonnée :
            @foreach($postgpx->tags as $tag)
              <span class="badge bg-secondary text-light">
                {{$tag->name}}
              </span>
            @endforeach
          </p>
          <p>Distance : {{$postgpx->distance}} km</p>
          <p>Distance effort : {{$postgpx->distEff}} km</p>
          <p>Dénivelé positif : {{$postgpx->eleAsc}} m</p>
          <p>Dénivelé négatif : {{$postgpx->eleDsc}} m</p>
          <p>Altitude de départ : {{$postgpx->eleStart}} m</p>
          <p>Altitude maximale : {{$postgpx->eleMax}} m</p>
          <p>Durée : {{date("H:i", strtotime($postgpx->duration))}}</p>
          <p>Difficulté : {{$postgpx->cat_difficulty->name}}</p>
          <p>Difficultée pour les toutous : {{$postgpx->cat_dogFriendly->name}}</p>
          @if (empty($postgpx->google))
          @else
            <p>Lien Google Maps : <a href='{{$postgpx->google}}' target="_blank">{{$postgpx->google}}</a></p>
          @endif
          @if (empty($postgpx->hut))
          @else
            <p>Cabane : {{$postgpx->hut}}</p>
          @endif
          @if (empty($postgpx->comments))
          @else
            <p>Remarques : {{$postgpx->comments}}</p>
          @endif  
  </div>
  <div class="col-6">
    <canvas id="myChart"></canvas>
  </div>
  <div class="col-12">
    <div id="map" style="height: 500px"></div>
  </div>
  
</div>
<script>
  var map = new L.Map('map', {
    crs: L.CRS.EPSG3857,
    continuousWorld: true,
    worldCopyJump: false
  });
  var url = 'https://wmts20.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-farbe/default/current/3857/{z}/{x}/{y}.jpeg';
  var tilelayer = new L.tileLayer(url);
  var mapLat = <?php echo json_encode($mapLat, JSON_HEX_TAG); ?>;
  var mapLon = <?php echo json_encode($mapLon, JSON_HEX_TAG); ?>;
  map.addLayer(tilelayer);
  map.setView(L.latLng(46.57591, 7.84956), 8);
  var marker = L.marker([mapLat[1], mapLon[1]]).addTo(map);
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