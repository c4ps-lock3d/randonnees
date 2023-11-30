@extends('base')

@section('title', 'Créer une randonnée')

@section('content')
    <h1>Créer une randonnée</h1>
    <form action="" method="post">
    @csrf
        <div class="form-group pb-2">
            {{-- L'attribut "value" permet de garder en mémoire l'ancienne valeur en cas d'erreur --}}
            <input type="text" name="title" value="{{ old('title', '') }}" placeholder="Titre" class="form-control" id="title">
            @error("title")
                {{ $message }}
            @enderror
            @error("slug")
                {{ $message }}
            @enderror
        </div>
        <div class="row pb-2">
        <div class="col form-group">
            <select name="area" class="form-control" id="area">
            <option>Vaud</option>
            <option>Valais</option>
            <option>Fribourg</option>
            <option>Oberland bernois</option>
            <option>Crêtes du Jura</option>
            <option>Grisons</option>
            <option>Schwytz</option>
            <option>France</option>
            </select>
            @error("area")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="layout" class="form-control" id="layout">
            <option>Boucle</option>
            <option>Aller-retour</option>
            <option>Aller</option>
            </select>
            @error("layout")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="topography" class="form-control" id="topography">
            <option>Sommet montagneux</option>
            <option>Gorges</option>
            <option>Col de Montagne</option>
            <option>Refuge de montagne</option>
            <option>Lac de montagne</option>
            <option>Ballade</option>
            <option>Village de montagne</option>
            <option>Point de vue</option>
            <option>Randonnée à plat</option>
            </select>
            @error("topography")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="text" name="hut" value="{{ old('hut', '') }}" placeholder="Cabane" class="form-control" id="hut">
            @error("hut")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="row pb-2">
        <div class="col form-group">
            <input type="number" step="0.1" name="distance" value="{{ old('distance', '') }}" placeholder="Distance [km]" class="form-control" id="distance">
            @error("distance")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleAsc"  value="{{ old('eleAsc', '') }}"placeholder="Dénivelé positif [m]" class="form-control" id="eleAsc">
            @error("eleAsc")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleDsc"  value="{{ old('eleDsc', '') }}"placeholder="Dénivelé négatif [m]" class="form-control" id="eleDsc">
            @error("eleDsc")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleStart"  value="{{ old('eleStart', '') }}"placeholder="Altitude départ [m]" class="form-control" id="eleStart">
            @error("eleStart")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleMax" value="{{ old('eleMax', '') }}" placeholder="Altitude max [m]" class="form-control" id="eleMax">
            @error("eleMax")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="row pb-2">
        <div class="col form-group">
            <input type="date" name="date" value="{{ old('date', '') }}" class="form-control" id="date">
            @error("date")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="time" name="duration" value="{{ old('duration', '') }}" class="form-control" id="duration">
            @error("duration")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="difficulty" class="form-control" id="difficulty">
            <option>T1</option>
            <option>T2</option>
            <option>T2+</option>
            <option>T3</option>
            <option>T3+</option>
            </select>
            @error("difficulty")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="dogFriendly" class="form-control" id="dogFriendly">
            <option>oui - facile</option>
            <option>oui - moyen</option>
            <option>oui - difficile</option>
            <option>non</option>
            </select>
            @error("dogFriendly")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="form-group pb-2">
            <input type="url" name="google" value="{{ old('google', '') }}" placeholder="Lien Google Maps" class="form-control" id="google">
            @error("google")
                {{ $message }}
            @enderror
        </div>
        <div class="form-group pb-2">
            <input type="text" name="comments" value="{{ old('comments', '') }}" placeholder="Remarques" class="form-control" id="comments">
            @error("comments")
                {{ $message }}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark">Créer</button>
    </form>
@endsection