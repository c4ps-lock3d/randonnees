@extends('base')

@section('title', 'Créer une randonnée')

@section('content')
    <h1>Créer une randonnée</h1>
    <form action="" method="post">
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
            <select name="cat_area_id" class="form-control" id="cat_area">
                @foreach ($cat_areas as $cat_area)
                    <option value="{{ $cat_area->id }}">{{ $cat_area->name }}</option>
                @endforeach
            </select>
            @error("cat_area_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_layout_id" class="form-control" id="cat_layout">
                @foreach ($cat_layouts as $cat_layout)
                    <option value="{{ $cat_layout->id }}">{{ $cat_layout->name }}</option>
                @endforeach
            </select>
            @error("cat_layouts_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_topography_id" class="form-control" id="cat_topography">
                @foreach ($cat_topographies as $cat_topography)
                    <option value="{{ $cat_topography->id }}">{{ $cat_topography->name }}</option>
                @endforeach
            </select>
            @error("cat_topography_id")
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
            <select name="cat_difficulty_id" class="form-control" id="cat_difficulty">
                @foreach ($cat_difficulties as $cat_difficulty)
                    <option value="{{ $cat_difficulty->id }}">{{ $cat_difficulty->name }}</option>
                @endforeach
            </select>
            @error("cat_difficulty_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_dogfriendly_id" class="form-control" id="cat_dogfriendly">
                @foreach ($cat_dogfriendlies as $cat_dogfriendly)
                    <option value="{{ $cat_dogfriendly->id }}">{{ $cat_dogfriendly->name }}</option>
                @endforeach
            </select>
            @error("cat_dogfriendly_id")
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