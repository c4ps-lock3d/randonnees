@extends('base')

@section('title', 'Ajouter une randonnée')

@section('content')
    <h1>Ajouter une randonnée</h1>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card text-dark bg-light">
            <div class="card-header">Importation d'un fichier GPX</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <input class="form-control-file" type="file" id="gpxpath" name="gpxpath">
                            @error("gpxpath")
                                    {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark">Importer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <a href="{{ route('blog.create')}}"><button class="btn btn-outline-dark">Fichier GPX inexistant, entrer les données manuellement</button></a>
        </div>
    </div>
@endsection