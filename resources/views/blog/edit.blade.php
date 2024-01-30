@extends('base')

@section('title', 'Editer une randonnée')

@section('content')
    <h1>Ajouter/editer une randonnée</h1>
    <form action="" method="post">
    @csrf
        <div class="row">
            <div class="col-xl-6 form-group">
            <div class="card h-100 text-dark border-success shadow-lg"  style="border-width:2px">
                <div class="card-header">Données GPX</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <div class="form-group row mb-0">
                            {{-- L'attribut "value" permet de garder en mémoire l'ancienne valeur en cas d'erreur --}}
                            <label class="col-sm-3 col-form-label" for="title">Titre</label>
                            <div class="col-sm-9"><input type="text" name="title" value="{{ old('title', $postgpx->title) }}" class="form-control" id="title"></div>
                            @error("title")
                                {{ $message }}
                            @enderror
                            @error("slug")
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Distance</label>    
                        <div class="col-sm-9 input-group"><input type="number" step="0.1" name="distance" value="{{ old('distance', $postgpx->distance) }}" class="form-control" id="distance">
                        <div class="input-group-append">
                            <span class="input-group-text" id="distance">km</span>
                        </div>
                        </div>
                        @error("distance")
                            {{ $message }}
                        @enderror
                    </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Dénivelé pos.</label>
                        <div class="col-sm-9 input-group"><input type="number" name="eleAsc" value="{{ old('eleAsc', $postgpx->eleAsc) }}" class="form-control" id="eleAsc">
                        <div class="input-group-append">
                            <span class="input-group-text" id="eleAsc">m</span>
                        </div>
                        </div>
                        @error("eleAsc")
                            {{ $message }}
                        @enderror
                    </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Dénivelé nég.</label>
                        <div class="col-sm-9 input-group"><input type="number" name="eleDsc" value="{{ old('eleDsc', $postgpx->eleDsc) }}" class="form-control" id="eleDsc">
                        <div class="input-group-append">
                            <span class="input-group-text" id="eleDsc">m</span>
                        </div>
                        </div>
                        @error("eleDsc")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Altitude dép.</label>
                        <div class="col-sm-9 input-group"><input type="number" name="eleStart" value="{{ old('eleStart', $postgpx->eleStart) }}" class="form-control" id="eleStart">
                        <div class="input-group-append">
                            <span class="input-group-text" id="eleStart">m</span>
                        </div>
                        </div>
                        @error("eleStart")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Altitude max.</label>
                        <div class="col-sm-9 input-group"><input type="number" name="eleMax" value="{{ old('eleMax', $postgpx->eleMax) }}" class="form-control" id="eleMax">
                        <div class="input-group-append">
                            <span class="input-group-text" id="eleMax">m</span>
                        </div>
                        </div>
                        @error("eleMax")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Date</label>
                        <div class="col-sm-9 input-group"><input type="date" name="date" value="{{ old('date', $postgpx->date) }}" class="form-control" id="date"></div>
                        @error("date")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Durée</label>
                        <div class="col-sm-9 input-group"><input type="time" name="duration"  value="{{ old('duration', $postgpx->duration) }}" class="form-control" id="duration"></div>
                        @error("duration")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6 form-group">
            <div class="card h-100 text-dark border-secondary shadow-lg" style="border-width:2px">
                <div class="card-header">Données additionelles</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Région</label>
                    <div class="col-sm-9 input-group"><select name="cat_area_id" class="form-control" id="cat_area">
                            @foreach ($cat_areas as $cat_area)
                                <option @selected(old('cat_area_id', $postgpx->cat_area_id) == $cat_area->id) value="{{ $cat_area->id }}">{{ $cat_area->name }}</option>
                            @endforeach
                        </select></div>
                        @error("cat_area_id")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Tracé</label>
                    <div class="col-sm-9 input-group"><select name="cat_layout_id" class="form-control" id="cat_layout">
                            @foreach ($cat_layouts as $cat_layout)
                                <option @selected(old('cat_layout_id', $postgpx->cat_layout_id) == $cat_layout->id) value="{{ $cat_layout->id }}">{{ $cat_layout->name }}</option>
                            @endforeach
                        </select></div>
                        @error("cat_layout_id")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    @php $tagsIds = $postgpx->tags()->pluck('id');@endphp
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="tag">Tags</label>
                    <div class="col-sm-9 input-group"><select name="tags[]" class="form-control" id="tag" multiple="multiple" style="height:100%" size="9">
                            @foreach ($tags as $tag)
                                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select></div>
                        @error("tags")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Difficultée</label>
                    <div class="col-sm-9 input-group"><select name="cat_difficulty_id" class="form-control" id="cat_difficulty">
                        @foreach ($cat_difficulties as $cat_difficulty)
                            <option @selected(old('cat_difficulty_id', $postgpx->cat_difficulty_id) == $cat_difficulty->id) value="{{ $cat_difficulty->id }}">{{ $cat_difficulty->name }}</option>
                        @endforeach
                    </select></div>
                    @error("cat_difficulty_id")
                        {{ $message }}
                    @enderror
                    </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Difficulté chien</label>
                    <div class="col-sm-9 input-group"><select name="cat_dogfriendly_id" class="form-control" id="cat_dogfriendly">
                            @foreach ($cat_dogfriendlies as $cat_dogfriendly)
                                <option @selected(old('cat_dogfriendly_id', $postgpx->cat_dogfriendly_id) == $cat_dogfriendly->id) value="{{ $cat_dogfriendly->id }}">{{ $cat_dogfriendly->name }}</option>
                            @endforeach
                        </select></div>
                        @error("cat_dogfriendly_id")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Cabane</label>
                    <div class="col-sm-9 input-group"><input type="text" name="hut" value="{{ old('hut', $postgpx->hut) }}" class="form-control" id="hut"></div>
                        @error("hut")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Lien Google</label>
                    <div class="col-sm-9 input-group"><input type="url" name="google" value="{{ old('google', $postgpx->google) }}" class="form-control" id="google"></div>
                        @error("google")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Remarques</label>
                    <div class="col-sm-9 input-group"><input type="text" name="comments" class="form-control" id="comments"></div>
                        @error("comments")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            </div>
                </div>
        </div>
        <button type="submit" class="btn btn-dark">Valider</button>
    </form>
@endsection