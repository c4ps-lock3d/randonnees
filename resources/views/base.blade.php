<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/759283867f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css?v=').time()}}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis&display=swap">

    <!-- Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm bg-dark text-light">
<div class="container">
<a class="" href="{{ route('blog.welcome') }}"><svg stroke-width="0.1px" stroke="white" width="45px" height="45px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>hiking</title><path d="M17.47 8.67H19V23H17.47V12.6C16.67 12.44 15.92 12.14 15.21 11.71S13.9 10.78 13.39 10.2L12.77 13.27L15 15.47V23H13V17L10.76 14.8L8.89 23H6.73C6.73 23 9.86 7.22 9.89 7.09C10 6.61 10.22 6.24 10.59 6C10.96 5.73 11.33 5.6 11.71 5.6C12.1 5.6 12.46 5.69 12.79 5.87C13.13 6.04 13.39 6.29 13.58 6.61L14.64 8.24C14.93 8.78 15.32 9.25 15.81 9.63S16.86 10.3 17.47 10.5V8.67M8.55 5.89L7.4 5.65C6.83 5.5 6.31 5.62 5.84 5.94C5.38 6.26 5.1 6.7 5 7.28L4.19 11.26C4.16 11.55 4.22 11.81 4.38 12.05C4.54 12.29 4.75 12.42 5 12.46L7.21 12.89L8.55 5.89M13 1C11.9 1 11 1.9 11 3S11.9 5 13 5 15 4.11 15 3 14.11 1 13 1Z" /></svg></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a @class(['nav-link', 'active' => request()->route()->getName() == 'blog.welcome']) href="{{ route('blog.welcome') }}">Acceuil<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a @class(['nav-link', 'active' => request()->route()->getName() == 'blog.index']) href="{{ route('blog.index') }}">Toutes les randonnées<span class="sr-only"></span></a>
      </li>
      <li class="nav-item dropdown">
        <a @class(['nav-link dropdown-toggle', 'active' => request()->route()->getName() == 'blog.corse2023']) href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          carnets de voyage
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('blog.corse2023') }}">Corse 2023</a>
      </li>
      <li class="nav-item">
        <a @class(['nav-link', 'active' => request()->route()->getName() == 'blog.about']) href="{{ route('blog.about') }}">A propos <span class="sr-only"></span></a>
      </li>
    </ul>
    <ul class="navbar-nav navbar-right">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Illuminate\Support\Facades\Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('blog.creategpx')}}">Ajouter une randonnée</a>
            <div class="dropdown-divider"></div>
            <form class="dropdown-item" action="{{ route('auth.logout')}}" method="post">
              @method('delete')  
              @csrf
              <button style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;">Se déconnecter</button>
            </form>
        </li> 
      @endauth
      @guest
        <div class="nav-item">
          <a href="{{ route('auth.login')}}"><button style="width:120px" class="btn btn-secondary">Se connecter</button></a>
        </div>
      @endguest
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>
   
<div class="container">
    @if(session('success'))
      <div class="alert alert-success" style="margin-top:15px">
        {{ session('success')}}
      </div>
    @endif
  @yield('content')
<div>

<script>
  new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}, no_backspace_delete: {title: 'NoDelete'}}})
</script>
<script type="text/javascript">
    $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
        e.stopPropagation();
    });
</script>


</body>
</html>