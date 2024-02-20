@extends('base')

@section('title', $postgpx->title)

@section('content')
@auth
<a href="{{ route('blog.edit', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])}}"><button style="margin-top:15px" class="btn btn-dark">Modifier</button></a>
@endauth
<h1>{{$postgpx->title}}</h1>
<div class="row">

<div class="col-6">
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
</div>

        <div class="col-6">
            <canvas id="myChart"></canvas>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
  var varChartDis = {{ Js::from($chartDis) }};
  var varChartEle = {{ Js::from($chartEle) }};
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: varChartDis,
      display: true,
      datasets: [{
        label: 'Altitude',
        data: varChartEle,
        borderWidth: 0,
        fill: true,
        pointStyle: 'circle',
        pointRadius: 1,
        pointHoverRadius: 15
      }]
    },
    options: {
      scales: { 
        x: {
          display: true,
          ticks: {
            stepSize: 0.5
          },
          title: {
            display: true,
            text: 'Distance',
          },
        },
        y: {
          beginAtZero: false,
          display: true,
          ticks: {
            stepSize: 100
          }
        },
      }
    }
  });
</script>

    
@endsection