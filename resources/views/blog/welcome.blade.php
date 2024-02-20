@extends('base')

@section('title', 'Bienvenue')

@section('content')   
    <h1></h1>
    <div class="row">
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div style="text-align:center" class="card-header">
                    <p class="card-text">Nombre de randonnées par régions</p>
                </div>
                <div style="text-align:center" class="card-body">
                
                <div>
                    <canvas id="myChart"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script type="text/javascript">
                    var varChartCatArea = {{ Js::from($list_areas) }};
                    var varChartCatAreaCount = {{ Js::from($count_list_areas) }};
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: varChartCatArea,
                            datasets: [{
                                label: 'Nombre de randonnées',
                                data: varChartCatAreaCount,
                                backgroundColor: [
                                        '#FFB3C2',
                                        '#A0D0F6',
                                        '#FFE6AD',        
                                        '#ABDFDF'
                                ],
                                hoverOffset: 4
                            }],

                            
                        },
                        options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'bottom',
                                        },
                                        title: {
                                            display: false,
                                            text: 'Chart.js Doughnut Chart'
                                        }
                                    }
                                },
                    });
                </script>
            </div>    
            </div>
        </div>
        <div class="col-lg-4 pb-4">
            <div class="card h-100 text-dark bg-light shadow-lg">
                <div style="text-align:center" class="card-header">
                    <p class="card-text">Nombre de randonnées par échelle de difficutée</p>
                </div>
                <div style="text-align:center" class="card-body">
                <div>
                    <canvas id="myChartDifficulty"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script type="text/javascript">
                    var varChartCatDifficulty = {{ Js::from($list_difficulties) }};
                    var varChartCatDifficultyCount = {{ Js::from($count_list_difficulties) }};
                    const ctxDifficulty = document.getElementById('myChartDifficulty');
                    new Chart(ctxDifficulty, {
                        type: 'doughnut',
                        data: {
                            labels: varChartCatDifficulty,
                            datasets: [{
                                label: 'Nombre de randonnées',
                                data: varChartCatDifficultyCount,
                                backgroundColor: [
                                        '#FFB3C2',
                                        '#A0D0F6',
                                        '#FFE6AD',        
                                        '#ABDFDF'
                                ],
                                hoverOffset: 4
                            }],

                            
                        },
                        options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'bottom',
                                        },
                                        title: {
                                            display: false,
                                            text: 'Chart.js Doughnut Chart'
                                        }
                                    }
                                },
                    });
                </script>
            </div>    
            </div>
        </div>
        <div class="col-lg-4">

            <div class="row">
                <div class="col-lg-12 pb-4">
                    <div class="card text-dark bg-light shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Nombre de randonnées enregistrées</p>
                        </div>
                        <div style="text-align:center" class="card-body p-2">
                            
                            <p style="font-size:28px" class="card-text">{{$count_posts}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 pb-4">
                    <div class="card text-dark bg-light shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Distance totale parcourue</p>
                        </div>
                        <div style="text-align:center" class="card-body p-2">
                            <p style="font-size:28px" class="card-text">{{round($sum_distance,0)}} km</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 pb-3">
                    <div class="card text-dark bg-light shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Durée totale de randonnée</p>
                        </div>
                        <div style="text-align:center" class="card-body p-2">
                            <p style="font-size:28px" class="card-text">x jours</p>
                        </div>
                    </div>
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