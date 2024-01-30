<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Gpx;
use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\FormGpxRequest;
use App\Models\CatArea;
use App\Models\CatDifficulty;
use App\Models\CatDogfriendly;
use App\Models\CatLayout;
use App\Models\CatTopography;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Welcome
    public function welcome(Gpx $postgpx):RedirectResponse | View{
        return view('blog.welcome', [
            'postgpx' => $postgpx,
            'last_posts' => Gpx::get()->sortByDesc("date")->skip(0)->take(3),
            'count_posts' => Gpx::count(),
            'sum_distance' => Gpx::get()->sum('distance'),
            'fav_areas' => CatArea::select('name')->groupBy('name')->orderByRaw('COUNT(*) DESC')->limit(1)->get(),
            //'getCol' => Gpx::select('name')->join('gpx_tag', 'gpxes.cat_area_id', '=', 'cat_areas.id')->where('cat_areas.name', $postgpx->name)->get()
        ]);
    }
    
    // Afficher et trier
    public function index(Request $request): View{
        $query = Gpx::with('tags','cat_area')->get()->sortByDesc("date");
       
        if($request->has('triDateDesc')){
            $query = Gpx::with('tags','cat_area')->get()->sortByDesc("date");
        }
        if($request->has('triDateAsc')){
            $query = Gpx::with('tags','cat_area')->get()->sortBy("date");
        }
        if($request->has('triDistEffDesc')){
            $query = Gpx::with('tags','cat_area')->get()->sortByDesc("distEff");
        }
        if($request->has('triDistEffAsc')){
            $query = Gpx::with('tags','cat_area')->get()->sortBy("distEff");
        }
        return view('blog.index', [
            'gpxes' => $query
        ]);  
    }

    public function show(string $slug, Gpx $postgpx):RedirectResponse | View{
        // Inutile grâce au Model Binding --> $post = Post::findOrFail($post);
        if($postgpx->slug != $slug){
            return to_route('blog.show', ['slug' => $postgpx->slug, 'id' => $postgpx->id]);
        }
        return view('blog.show',[
            'postgpx' => $postgpx,
        ]);
    }
    
    // Créer
    public function create(){
        $postgpx = new Gpx();
        return view('blog.create', [
            'postgpx' => $postgpx,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function store(FormPostRequest $request){
        $postgpx = Gpx::create($request->validated());
        $postgpx->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])->with('success', "Bravo, la randonnée a été créée.");
    }

    // Editer
    public function edit(Gpx $postgpx){
        return view('blog.edit',[
            'postgpx' => $postgpx,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function update(Gpx $postgpx, FormPostRequest $request){
        $postgpx->update($request->validated());
        $postgpx->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $postgpx->slug, 'postgpx' => $postgpx->id])->with('success', "Bravo, la randonnée a été modifiée.");
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
    public function storegpx(Gpx $postgpx, FormGpxRequest $request){
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
        $date = date(substr($gpx->metadata->time,0,10));
    
        foreach ($gpx->wpt as $pt) {
            foreach ($pt->extensions as $ex) {     
            $distance = round($waypoint_stage_before = $ex->waypoint_stage_before['distance']/1000,1);
            $duration = date("H:i",$waypoint_stage_before = (int) $ex->waypoint_stage_before['duration']);
            $eleAsc = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['ascent'],0);
            $eleDsc = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['descent'],0);    
        }}
    
        $arr = array();
        foreach ($gpx->trk as $trak) {
            foreach ($trak->trkseg as $trakseg) {
                foreach ($trakseg->trkpt as$trakpt) {
                   $arr[] = (int) $trakpt->ele;
        }}}
        $eleMax = max($arr);
        $postgpx = Gpx::create([
            'gpxpath' => $imagePath,
            'eleStart' => $eleStart,
            'title' => $title,
            'date' => $date,
            'distance' => $distance,
            'duration' => $duration,
            'eleAsc' => $eleAsc,
            'eleDsc' => $eleDsc,
            'eleMax' => $eleMax,
            'slug' => Str::slug($title),
            'distEff' => round($distance+$eleAsc/100+$eleDsc/400, 1)
        ]);
        return redirect()->route('blog.edit',[
            'postgpx' => $postgpx,
            'tags' => Tag::select('id', 'name')->get(),
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ])->with('success', "Importation GPX effectuée. L'ajout de données additionelles est possible.");
    }
}