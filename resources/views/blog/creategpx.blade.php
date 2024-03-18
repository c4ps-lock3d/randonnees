@extends('base')

@section('title', 'Ajouter une randonnée')

@section('content')
    <h2>Ajouter une randonnée</h2><hr>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form class="pb-4" action="" method="post" enctype="multipart/form-data">
                <div class="card text-light bg-dark shadow-lg">
                <div class="card-header">Importation d'un fichier GPX</div>
                    <div class="card-body">
                        
                        @csrf
                            <div class="form-group mb-3">
                                <input class="form-control" type="file" id="gpxpath" name="gpxpath">
                                @error("gpxpath")
                                        {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary">Importer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 mx-auto">
            <a href="{{ route('blog.create')}}"><button style="width:100%" class="btn btn-dark text-light">Fichier GPX inexistant, entrer les données manuellement</button></a>
        </div>
    </div>
@endsection