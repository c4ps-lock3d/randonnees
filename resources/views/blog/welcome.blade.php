@extends('base')

@section('title', 'Bienvenue')

@section('content')   
<div class="row">
    <div class="col-1 pt-3">     
        <img src="{{url('img/wallace.webp')}}" alt="..." style="width:90px;height:90px;border-radius:50% 50%;border:0.15em solid black">
    </div>
    <div class="col-11 pt-3 my-auto">     
        <h4 style="text-align:justify"><i>“Salut ! Je m'appelle Wallace. Ce que j'aime dans la vie c'est jouer au freezbee, la physique quantique et promener mes humains des heures durant en montagne, dans les plus belles régions de Suisse”</i></h4>
    </div>
</div><hr>     
<div class="row">
        <div class="col-xxl-4 col-lg-4 col-md-6 pb-4">
            <div class="card h-100 text-light bg-dark shadow-lg">
                <div style="text-align:center" class="card-header">
                    <p class="card-text">Randonnées par régions</p>
                </div>
                <div style="text-align:center" class="mx-auto card-body">
                <div>
                    <canvas id="myChartArea"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script type="text/javascript">
                    var varChartCatArea = <?php echo json_encode($list_areas, JSON_HEX_TAG); ?>;
                    var varChartCatAreaCount = <?php echo json_encode($count_list_areas, JSON_HEX_TAG); ?>;
                    const ctxArea = document.getElementById('myChartArea');
                    new Chart(ctxArea, {
                        type: 'doughnut',
                        data: {
                            labels: varChartCatArea,    
                            datasets: [{
                                label: 'Nombre de randonnées',
                                data: varChartCatAreaCount,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.8)',
                                    'rgba(255, 159, 64, 0.8)',
                                    'rgba(255, 205, 86, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(153, 102, 255, 0.8)',
                                    'rgba(201, 203, 207, 0.8)'
                                ],
                                hoverOffset: 4,
                                borderWidth: 1,
                            }],                  
                        },
                        options: {
                                    responsive: false,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'bottom',
                                            labels: {
                                                pointStyle: 'rect',
                                                usePointStyle: true,
                                                color: '#F8F9FA',
                                                padding:15
                                            },
                                        },
                                        title: {
                                            display: false,
                                            text: 'Chart.js Doughnut Chart'
                                        }
                                    },
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true
                                    }
                                },
                                
                    });
                </script>
            </div>    
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 pb-4">
            <div class="card h-100 text-light bg-dark shadow-lg p-0">
                <div style="text-align:center" class="card-header">
                    <p class="card-text">Randonnées par échelle de difficutée</p>
                </div>
                <div style="text-align:center" class="mx-auto card-body">
                <div>
                    <canvas id="myChartDifficulty"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script type="text/javascript">

                    var varChartCatDifficulty = <?php echo json_encode($list_difficulties, JSON_HEX_TAG); ?>;
                    var varChartCatDifficultyCount = <?php echo json_encode($count_list_difficulties, JSON_HEX_TAG); ?>;
                    const ctxDifficulty = document.getElementById('myChartDifficulty');
                    new Chart(ctxDifficulty, {
                        type: 'doughnut',
                        data: {
                            labels: varChartCatDifficulty,
                            datasets: [{
                                label: 'Nombre de randonnées',
                                data: varChartCatDifficultyCount,
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(255, 205, 86, 0.8)',
                                    'rgba(255, 159, 64, 0.8)',
                                    'rgba(255, 99, 132, 0.8)',
                                ],
                                hoverOffset: 4,
                                borderWidth: 1,
                            }],                           
                        },
                        options: {
                                    responsive: false,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'bottom',
                                            labels: {
                                                pointStyle: 'rect',
                                                usePointStyle: true,
                                                color: '#F8F9FA',
                                                padding:20
                                            },

                                        },
                                        title: {
                                            display: false,
                                            text: 'Chart.js Doughnut Chart'
                                        }
                                    },
                                    layout: {
                                        padding: {
                                            bottom:20
                                        }
                                    },
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true
                                    }
                                },
                    });
                </script>
            </div>    
            </div>
        </div>
        <div class="col-lg-4 col-md-12">

            <div class="row">
                <div class="col-lg-12 col-md-12 pb-4">
                    <div class="card text-light bg-dark shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Nombre de randonnées enregistrées</p>
                        </div>
                        <div style="text-align:center;padding:0.66rem" class="card-body">     
                            <p style="font-size:28px" class="card-text">{{$count_posts}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 pb-4">
                    <div class="card text-light bg-dark shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Distance totale parcourue</p>
                        </div>
                        <div style="text-align:center;padding:0.79rem" class="card-body">
                            <p style="font-size:28px" class="card-text">{{round($sum_distance,0)}} km</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 pb-4">
                    <div class="card text-light bg-dark shadow-lg">
                        <div style="text-align:center" class="card-header">
                            <p class="card-text">Durée totale parcourue</p>
                        </div>
                        <div style="text-align:center;padding:0.79rem"" class="card-body">
                            <p style="font-size:28px" class="card-text">{{round($sum_duration/3600),0}} heures</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
    <div class="col-xxl-3 col-lg-4 col-md-6 pb-4">
        @foreach($last_posts as $postgpx)
        
            <div class="card h-100 text-light bg-dark shadow-lg">
            <div style="text-align:center" class="card-header">
                <p class="card-text">La plus récente</p>
            </div>
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
            @if($postgpx->image)
                <img src="storage/{{ $postgpx->image }}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @else
                    <img src="{{url('img/9121424.webp')}}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @endif
                <div class='card-img-overlay'>
                    <div class='bg-dark' style='font-size:14px;margin-top:25px;border-radius:0rem 0rem 0rem 0rem;' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
                </div>
                <div class="card-body pb-1">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row pt-3">
                    <div class="d-flex justify-content-between">
                                <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distance}} km
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distEff}} km-effort
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", strtotime($postgpx->duration))}}
                                  </p>
                                  </div>
                              </div>
                              </div>
                            <div class="row pt-3 pb-3">
                            <div class="d-flex justify-content-between">
                            <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-up"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-down"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
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
        
        @endforeach
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-6 pb-4">
        @foreach($highest_distEff as $postgpx)
            <div class="card h-100 text-light bg-dark shadow-lg">
            <div style="text-align:center" class="card-header">
                <p class="card-text">La plus physique</p>
            </div>
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
            @if($postgpx->image)
                <img src="storage/{{ $postgpx->image }}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @else
                    <img src="{{url('img/9121424.webp')}}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @endif
                <div class='card-img-overlay'>
                    <div class='bg-dark' style='font-size:14px;margin-top:25px;border-radius:0rem 0rem 0rem 0rem;' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
                </div>
                <div class="card-body pb-1">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row pt-3">
                    <div class="d-flex justify-content-between">
                                <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distance}} km
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distEff}} km-effort
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", strtotime($postgpx->duration))}}
                                  </p>
                                  </div>
                              </div>
                              </div>
                            <div class="row pt-3 pb-3">
                            <div class="d-flex justify-content-between">
                            <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-up"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-down"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
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
        @endforeach
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-6 pb-4">
        @foreach($highest_eleMax as $postgpx)
            <div class="card h-100 text-light bg-dark shadow-lg">
            <div style="text-align:center" class="card-header">
                <p class="card-text">La plus haute</p>
            </div>
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
            @if($postgpx->image)
                <img src="storage/{{ $postgpx->image }}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @else
                    <img src="{{url('img/9121424.webp')}}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @endif
                <div class='card-img-overlay'>
                    <div class='bg-dark' style='font-size:14px;margin-top:25px;border-radius:0rem 0rem 0rem 0rem;' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
                </div>
                <div class="card-body pb-1">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row pt-3">
                    <div class="d-flex justify-content-between">
                                <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distance}} km
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distEff}} km-effort
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", strtotime($postgpx->duration))}}
                                  </p>
                                  </div>
                              </div>
                              </div>
                            <div class="row pt-3 pb-3">
                            <div class="d-flex justify-content-between" style="text-align:left">
                            <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-up"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-down"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
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
        @endforeach
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-6 pb-4">
        @foreach($most_legendary as $postgpx)
            <div class="card h-100 text-light bg-dark shadow-lg">
            <div style="text-align:center" class="card-header">
                <p class="card-text">La plus mythique</p>
            </div>
            <a class="stretched-link" style="text-decoration: none" href="{{ route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id]) }}">
            @if($postgpx->image)
                <img src="storage/{{ $postgpx->image }}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @else
                    <img src="{{url('img/9121424.webp')}}" height="200" class="card-img-bottom" alt="..." style="object-fit:cover">
                @endif
                <div class='card-img-overlay'>
                    <div class='bg-dark' style='font-size:14px;margin-top:25px;border-radius:0rem 0rem 0rem 0rem;' id='newsDate'>&nbsp;{{date("d.m.Y", strtotime($postgpx->date))}} - {{$postgpx->canton}}</div>        
                </div>
                <div class="card-body pb-1">
                    <h5 class="card-title text-truncate font-weight-bold">{{$postgpx->title}}</h5>
                    <div class="row pt-3">
                    <div class="d-flex justify-content-between">
                                <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distance}} km
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-right"></span>&nbsp;&nbsp;{{$postgpx->distEff}} km-effort
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-timer-outline"></span>&nbsp;&nbsp;{{date("H:i", strtotime($postgpx->duration))}}
                                  </p>
                                  </div>
                              </div>
                              </div>
                            <div class="row pt-3 pb-3">
                            <div class="d-flex justify-content-between">
                            <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-up"></span>&nbsp;&nbsp;{{$postgpx->eleAsc}} m 
                                  </p>
                              </div>
                              <div class="">
                                  <p class="card-text">
                                    <span class="mdi mdi-arrow-down"></span>&nbsp;&nbsp;{{$postgpx->eleDsc}} m
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
        @endforeach
        </div>
    <div>
@endsection