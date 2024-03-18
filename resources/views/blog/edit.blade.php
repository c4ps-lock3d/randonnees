@extends('base')

@section('title', 'Editer une randonnée')

@section('content')
    <h1>Ajouter/editer une randonnée</h1>
    <form action="" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-xl-6 form-group">
            <div class="card h-100 text-light bg-dark shadow-lg"  style="border-width:2px">
                <div class="card-header">Données GPX</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <div class="form-group row mb-0">
                            {{-- L'attribut "value" permet de garder en mémoire l'ancienne valeur en cas d'erreur --}}
                            <label class="col-sm-3 col-form-label" for="title">Titre</label>
                            <div class="col-sm-9 mb-2"><input type="text" name="title" value="{{ old('title', $postgpx->title) }}" class="form-control" id="title"></div>
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
                        <label class="col-sm-3 col-form-label" for="title">Canton</label>
                        <div class="col-sm-9 mb-2"><input type="text" name="canton" id="canton" class="form-control"></div>
                        @error("canton")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Commune</label>
                        <div class="col-sm-9 mb-2"><input type="text" name="commune" class="form-control" id="commune"></div>
                        @error("commune")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                            <div class="col-3">
                                <label class="form-label" for="title">Distance</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group mb-2">
                                    <input class="form-control" type="number" step="0.1" name="distance" value="{{ old('distance', $postgpx->distance) }}" id="distance">
                                    <span class="input-group-text" id="distance">km</span>
                                </div>
                            </div>
                        @error("distance")
                            {{ $message }}
                        @enderror
                    </div>
                    </div>
                    <div class="col-xxl-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Dénivelé pos.</label>
                        <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="number" name="eleAsc" value="{{ old('eleAsc', $postgpx->eleAsc) }}" class="form-control" id="eleAsc">
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
                        <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="number" name="eleDsc" value="{{ old('eleDsc', $postgpx->eleDsc) }}" class="form-control" id="eleDsc">
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
                        <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="number" name="eleStart" value="{{ old('eleStart', $postgpx->eleStart) }}" class="form-control" id="eleStart">
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
                        <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="number" name="eleMax" value="{{ old('eleMax', $postgpx->eleMax) }}" class="form-control" id="eleMax">
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
                        <div class="col-sm-9 mb-2"><input type="date" name="date" value="{{ old('date', $postgpx->date) }}" class="form-control" id="date"></div>
                        @error("date")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label" for="title">Durée</label>
                        <div class="col-sm-9 mb-2"><input type="time" name="duration"  value="{{ old('duration', $postgpx->duration) }}" class="form-control" id="duration"></div>
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
            <div class="card h-100 text-light bg-dark shadow-lg" style="border-width:2px">
                <div class="card-header">Données additionelles</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Tracé</label>
                    <div class="col-sm-9 mb-2"><select name="cat_layout_id" class="form-control" id="cat_layout">
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
                    <div class="col-sm-9 mb-2"><select name="tags[]" class="form-control" id="tag" multiple="multiple" style="height:100%" size="9">
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
                    <div class="col-sm-9 mb-2"><select name="cat_difficulty_id" class="form-control" id="cat_difficulty">
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
                    <div class="col-sm-9 mb-2"><select name="cat_dogfriendly_id" class="form-control" id="cat_dogfriendly">
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
                    <div class="col-sm-9 mb-2"><input type="text" name="hut" value="{{ old('hut', $postgpx->hut) }}" class="form-control" id="hut"></div>
                        @error("hut")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
<!--                     <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Lien Google</label>
                    <div class="col-sm-9 mb-2"><input type="url" name="google" value="{{ old('google', $postgpx->google) }}" class="form-control" id="google"></div>
                        @error("google")
                            {{ $message }}
                        @enderror
                        </div>
                    </div> -->
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Remarques</label>
                    <div class="col-sm-9 mb-2"><input type="text" name="comments" class="form-control" id="comments"></div>
                        @error("comments")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 form-group">
                    <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label" for="title">Image</label>
                    <div class="col-sm-9 mb-2""><input type="file" name="image" class="form-control" id="image"></div>
                        @error("image")
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark mt-4">Valider</button>
    </form>

<script>
  var mapLat = <?php echo json_encode($mapLat, JSON_HEX_TAG); ?>;
  var mapLon = <?php echo json_encode($mapLon, JSON_HEX_TAG); ?>;
  const apiUrl ="https://api3.geo.admin.ch/rest/services/api/MapServer/identify?geometryType=esriGeometryPoint&returnGeometry=false&sr=4326&geometry="
                +mapLon[1]
                +","
                +mapLat[1]
                +"&imageDisplay=0,0,0&mapExtent=0,0,0,0&tolerance=0&layers=all:ch.swisstopo-vd.geometa-gemeinde";
  fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    for (var i = 0; i < 2; i++) {
      var myObject = JSON.parse(JSON.stringify(data));
      let strCanton = JSON.stringify(myObject.results[i].attributes.kanton);
      strCanton = strCanton.replace(/"/g, "");
      document.getElementById('canton').value = strCanton;
      let strCommune = JSON.stringify(myObject.results[i].attributes.gemeindename);
      strCommune = strCommune.replace(/"/g, "");
      document.getElementById('commune').value = strCommune;
    } 
  })
  .catch(error => {
    console.error('Error:', error);
  });
</script>
@endsection