@extends('base')

@section('title', 'Modifier une randonnée')

@section('content')
    <h1>Modifier une randonnée</h1>
    <form action="" method="post">
    @csrf
        <div class="form-group pb-2">
            {{-- L'attribut "value" permet de garder en mémoire l'ancienne valeur en cas d'erreur --}}
            <input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Titre" class="form-control" id="title">
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
                    <option @selected(old('cat_area_id', $post->cat_area_id) == $cat_area->id) value="{{ $cat_area->id }}">{{ $cat_area->name }}</option>
                @endforeach
            </select>
            @error("cat_area_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_layout_id" class="form-control" id="cat_layout">
                @foreach ($cat_layouts as $cat_layout)
                    <option @selected(old('cat_layout_id', $post->cat_layout_id) == $cat_layout->id) value="{{ $cat_layout->id }}">{{ $cat_layout->name }}</option>
                @endforeach
            </select>
            @error("cat_layout_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_topography_id" class="form-control" id="cat_topography">
                @foreach ($cat_topographies as $cat_topography)
                    <option @selected(old('cat_topography_id', $post->cat_topography_id) == $cat_topography->id) value="{{ $cat_topography->id }}">{{ $cat_topography->name }}</option>
                @endforeach
            </select>
            @error("cat_topography_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="text" name="hut" value="{{ old('hut', $post->hut) }}" placeholder="Cabane" class="form-control" id="hut">
            @error("hut")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="row pb-2">
        <div class="col form-group">
            <input type="number" step="0.1" name="distance" value="{{ old('distance', $post->distance) }}" placeholder="Distance [km]" class="form-control" id="distance">
            @error("distance")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleAsc" value="{{ old('eleAsc', $post->eleAsc) }}" placeholder="Dénivelé positif [m]" class="form-control" id="eleAsc">
            @error("eleAsc")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleDsc" value="{{ old('eleDsc', $post->eleDsc) }}" placeholder="Dénivelé négatif [m]" class="form-control" id="eleDsc">
            @error("eleDsc")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleStart" value="{{ old('eleStart', $post->eleStart) }}" placeholder="Altitude départ [m]" class="form-control" id="eleStart">
            @error("eleStart")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="number" name="eleMax" value="{{ old('eleMax', $post->eleMax) }}" placeholder="Altitude max [m]" class="form-control" id="eleMax">
            @error("eleMax")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="row pb-2">
        <div class="col form-group">
            <input type="date" name="date" value="{{ old('date', $post->date) }}" class="form-control" id="date">
            @error("date")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <input type="time" name="duration"  value="{{ old('duration', $post->duration) }}" class="form-control" id="duration">
            @error("duration")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_difficulty_id" class="form-control" id="cat_difficulty">
                @foreach ($cat_difficulties as $cat_difficulty)
                    <option @selected(old('cat_difficulty_id', $post->cat_difficulty_id) == $cat_difficulty->id) value="{{ $cat_difficulty->id }}">{{ $cat_difficulty->name }}</option>
                @endforeach
            </select>
            @error("cat_difficulty_id")
                {{ $message }}
            @enderror
        </div>
        <div class="col form-group">
            <select name="cat_dogfriendly_id" class="form-control" id="cat_dogfriendly">
                @foreach ($cat_dogfriendlies as $cat_dogfriendly)
                    <option @selected(old('cat_dogfriendly_id', $post->cat_dogfriendly_id) == $cat_dogfriendly->id) value="{{ $cat_dogfriendly->id }}">{{ $cat_dogfriendly->name }}</option>
                @endforeach
            </select>
            @error("cat_dogfriendly_id")
                {{ $message }}
            @enderror
        </div>
        </div>
        <div class="form-group pb-2">
            <input type="url" name="google" value="{{ old('google', $post->google) }}"placeholder="Lien Google Maps" class="form-control" id="google">
            @error("google")
                {{ $message }}
            @enderror
        </div>
        <div class="form-group pb-2">
            <input type="text" name="comments" placeholder="Remarques" class="form-control" id="comments">
            @error("comments")
                {{ $message }}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark">Modifier</button>
    </form>
@endsection