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
        <p>Durée : {{$postgpx->duration}}</p>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  
  var chartDis = {!! json_encode($chartDis->toArray()) !!};
  var chartEle = {!! json_encode($chartEle->toArray()) !!};
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
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