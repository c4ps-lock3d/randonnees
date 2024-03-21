<?php

namespace App\Http\Controllers;

use App\Models\Gpx;
use App\Models\Tag;
use App\Models\Trace;
use App\Models\CatDifficulty;
use App\Models\CatDogfriendly;
use App\Models\CatLayout;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\FormGpxRequest;
use Illuminate\Support\Str;
use App\Http\Requests\TraceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    // Welcome
    public function welcome(Gpx $postgpx):RedirectResponse | View{

        $list_difficulties = Gpx::join('cat_difficulties', 'gpxes.cat_difficulty_id', '=', 'cat_difficulties.id')->select('cat_difficulties.name')->distinct()->get()->pluck('name');
        foreach($list_difficulties as $list_difficulty){
            $difficulties_count[] = Gpx::join('cat_difficulties', 'gpxes.cat_difficulty_id', '=', 'cat_difficulties.id')->select('cat_difficulties.name')->where('cat_difficulties.name', $list_difficulty)->get()->count();
        }

        $list_areas = Gpx::select('canton')->distinct()->get()->pluck('canton');
        foreach($list_areas as $list_area){
            $areas_count[] = Gpx::select('canton')->where('canton', $list_area)->get()->count();
        }

        return view('blog.welcome', [
            'postgpx' => $postgpx,
            'last_posts' => Gpx::get()->sortByDesc("date")->skip(0)->take(1),
            'highest_distEff' => Gpx::get()->sortByDesc("distEff")->skip(0)->take(1),
            'highest_eleMax' => Gpx::get()->sortByDesc("eleMax")->skip(0)->take(1),
            'most_legendary' => Gpx::where('slug', 'zermatt-hornlihutte')->get(),
            'count_posts' => Gpx::count(),
            'sum_distance' => Gpx::get()->sum('distance'),
            'sum_duration' => Gpx::sum(Gpx::raw("TIME_TO_SEC(duration)")),
            'list_difficulties' => $list_difficulties,
            'count_list_difficulties' => $difficulties_count,
            'list_areas' => $list_areas,
            'count_list_areas' => $areas_count
        ]);
    }   
    
    // Afficher et trier
    public function index(Request $request, Gpx $query): View{
        $query = $query->newQuery();

        if($request->has('Sommet')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Sommet");
            });
        }
        if($request->has('Gorges')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Gorges");
            });
        }
        if($request->has('Col')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Col");
            });
        }
        if($request->has('Refuge')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Refuge");
            });
        }
        if($request->has('Lac')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Lac");
            });
        }
        if($request->has('Village')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Village");
            });
        }
        if($request->has('Panorama')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Panorama");
            });
        }
        if($request->has('Plat')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Plat");
            });
        }
        if($request->has('Balade')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Balade");
            });
        }
        if($request->has('Vaud')){
            $query->Where('canton', "Vaud");
        }
        if($request->has('Valais')){
            $query->Where('canton', "Valais");
        }
        if($request->has('Fribourg')){
            $query->Where('canton', "Fribourg");
        }
        if($request->has('Bern')){
            $query->Where('canton', "Bern");
        }
        if($request->has('Neuchâtel')){
            $query->Where('canton', "Neuchâtel");
        }
        if($request->has('Graubünden')){
            $query->Where('canton', "Graubünden");
        }
        if($request->has('Schwyz')){
            $query->Where('canton', "Schwyz");
        }
        if($request->has('T1')){
            $query->Where('cat_difficulty_id', 1);
        }
        if($request->has('T2')){
            $query->Where('cat_difficulty_id', 2);
        }
        if($request->has('T2+')){
            $query->Where('cat_difficulty_id', 3);
        }
        if($request->has('T3')){
            $query->Where('cat_difficulty_id', 4);
        }
        if($request->has('T3+')){
            $query->Where('cat_difficulty_id', 5);
        }
        if($request->has('facile')){
            $query->Where('cat_dogfriendly_id', 1);
        }
        if($request->has('moyen')){
            $query->Where('cat_dogfriendly_id', 2);
        }
        if($request->has('déconseillé')){
            $query->Where('cat_dogfriendly_id', 3);
        }
        if($request->has('Boucle')){
            $query->Where('cat_layout_id', 1);
        }
        if($request->has('Aller-Retour')){
            $query->Where('cat_layout_id', 2);
        }
        if($request->has('Aller')){
            $query->Where('cat_layout_id', 3);
        }
        if($request->has('triDateAsc')){
            $query->orderBy('date', 'asc');
        }
        if($request->has('triDateDesc')){
            $query->orderBy('date', 'desc');
        }
        if($request->has('triDistEffAsc')){
            $query->orderBy('distEff', 'asc');
        }
        if($request->has('triDistEffDesc')){
            $query->orderBy('distEff', 'desc');
        }
        if($request->has('triDurationAsc')){
            $query->orderBy('duration', 'asc');
        }
        if($request->has('triDurationDesc')){
            $query->orderBy('duration', 'desc');
        }
        $query->orderBy('date', 'desc');

        $list_areas = Gpx::select('canton')->distinct()->get()->pluck('canton');
        return view('blog.index', [
            'gpxes' => $query->get(),
            'tags' => Tag::select('id', 'name')->get(),
            'list_areas' => $list_areas,
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'count_posts' => $query->count(),
            'count_total_posts' => Gpx::count(),
        ]);
    }

    public function show(string $slug, Gpx $postgpx){
        // Inutile grâce au Model Binding --> $post = Post::findOrFail($post);
        if($postgpx->slug != $slug){
            return to_route('blog.show', ['slug' => $postgpx->slug, 'id' => $postgpx->id]);
        }
        $dataEle = Trace::select('ele')->where('gpx_id', $postgpx->id)->get()->pluck('ele');
        $dataDis = Trace::select('dis')->where('gpx_id', $postgpx->id)->get()->pluck('dis');
        $dataLat = Trace::select('lat')->where('gpx_id', $postgpx->id)->get()->pluck('lat');
        $dataLon = Trace::select('lon')->where('gpx_id', $postgpx->id)->get()->pluck('lon');
        return view('blog.show',[
            'postgpx' => $postgpx,
            'chartEle' => $dataEle,
            'chartDis' => $dataDis,
            'mapLat' => $dataLat,
            'mapLon' => $dataLon,
        ]);
    }
    
    // Créer
    public function create(){
        $postgpx = new Gpx();
        return view('blog.create', [
            'postgpx' => $postgpx,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function store(FormPostRequest $request){
        $postgpx = Gpx::create($request->validated());
        $postgpx->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', [
            'slug' => $postgpx->slug,
            'postgpx' => $postgpx->id,
        ])->with('success', "Bravo, la randonnée a été créée.");
    }

    // Editer
    public function edit(Gpx $postgpx){
        $dataLat = Trace::select('lat')->where('gpx_id', $postgpx->id)->get()->pluck('lat');
        $dataLon = Trace::select('lon')->where('gpx_id', $postgpx->id)->get()->pluck('lon');
        return view('blog.edit',[
            'postgpx' => $postgpx,
            'mapLat' => $dataLat,
            'mapLon' => $dataLon,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function update(Gpx $postgpx, FormPostRequest $request){
        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');

        //Autorise l'upload seulement si une image est ajoutée dans le champs image
        if ($image != null && !$image->getError()){
            $imgpath = $image->store('imgrando', 'public');
            $data['image'] = $imgpath;
        }
        $postgpx->update($data);
        $postgpx->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show',[
            'slug' => $postgpx->slug,
            'postgpx' => $postgpx->id,
        ])->with('success', "Bravo, la randonnée a été modifiée.");
    }

    // Pages uniques
    public function about(): View{
        return view('blog.about');
    }

    public function corse2023(): View{
        return view('blog.corse2023');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Créer GPX
    public function creategpx(){
        return view('blog.creategpx', [

        ]);
    }
    public function storegpx(Gpx $postgpx, FormGpxRequest $request, Trace $trace){
        /** @var UploadedFile|null $gpxpath */
        $postgpx = $request->validated('gpxpath');
        $imagePath = $postgpx->store('gpx');

        $datagpx = file_get_contents("../storage/app/".$imagePath);
        //$datagpx = str_replace('xmlns:schemaLocation="http://www.topografix.com/GPX/1/1/gpx.xsd https://swisstopo-app.ch/xmlschemas/SwisstopoExtensions https://prod-static.swisstopo-app.ch/xmlschemas/SwisstopoExtensions.xsd"', "", $datagpx);
        $datagpx = str_replace('xmlns:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd https://swisstopo-app.ch/xmlschemas/SwisstopoExtensions https://prod-static.swisstopo-app.ch/xmlschemas/SwisstopoExtensions.xsd"', "", $datagpx);
        $datagpx1 = str_replace('swisstopo:', "", $datagpx);
        //open gpx file
        $gpx = simplexml_load_string($datagpx1);
        
        $eleStart = round((int) $gpx->wpt->ele,0);
        $title = $gpx->metadata->name;
        //$date = date(substr($gpx->metadata->time,0,10));
        $date = date("Y-m-d", strtotime($gpx->metadata->time));
    
        foreach ($gpx->wpt as $pt) {
            foreach ($pt->extensions as $ex) {     
            $distance = round($waypoint_stage_before = $ex->waypoint_stage_before['distance']/1000,1);
            $duration = date("H:i",$waypoint_stage_before = (int) $ex->waypoint_stage_before['duration']);
            $eleAsc = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['ascent'],0);
            $eleDsc = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['descent'],0);    
        }}
   
        $postgpx = Gpx::create([
            'gpxpath' => $imagePath,
            'eleStart' => $eleStart,
            'title' => $title,
            'date' => $date,
            'distance' => $distance,
            'duration' => $duration,
            'eleAsc' => $eleAsc,
            'eleDsc' => $eleDsc,
            'eleMax' => 0,
            'slug' => Str::slug($title),
            'distEff' => round($distance+$eleAsc/100+$eleDsc/400, 1)
        ]);
        
        foreach ($gpx->trk->trkseg->trkpt as $trakpt) {
            $trace = Trace::create([
                'lat' => $trakpt['lat'],
                'lon' => $trakpt['lon'],
                'ele' => $trakpt->ele,
                'gpx_id' => $postgpx->id,
                'sid' => $trakpt->extensions->routepoint_id
            ]);
            $longitude[] = $trakpt['lon'];
            $latitude[] =  $trakpt['lat'];
            $sid[] =  $trakpt->extensions->routepoint_id;
            $gpx_id[] = $postgpx->id;
        }

        $distance = 0;
        for($i = 0; $i < count($gpx_id)-1; $i++){
            $theta = $longitude[$i] - $longitude[$i+1]; 
            $distance  = $distance + ((rad2deg(acos((sin(deg2rad((float)$latitude[$i])) * sin(deg2rad((float)$latitude[$i+1]))) + (cos(deg2rad((float)$latitude[$i])) * cos(deg2rad((float)$latitude[$i+1])) * cos(deg2rad((float)$theta))))))* 60 * 1.1515 * 1.609344); 
            Trace::where('sid', $sid[$i])->where('gpx_id', $postgpx->id)->update([
                'dis' => $distance
            ]);
        }

        $eleMax = Trace::where('gpx_id', $postgpx->id)->max('ele');
        Gpx::where('id', $postgpx->id)->update(['eleMax' => round($eleMax,0)]);

        return redirect()->route('blog.edit',[
            'postgpx' => $postgpx,
            'trace' => $trace,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ])->with('success', "Importation GPX effectuée. L'ajout de données additionelles est possible.");
    }
    public function downloadgpx(){
        return Storage::download('file.jpg');
    }
}