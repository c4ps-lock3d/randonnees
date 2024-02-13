<?php

namespace App\Http\Controllers;

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
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

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
        if($request->has('Ballade')){
            $query->orWhereHas('tags', function($querybuilder) {
                $querybuilder->where('tags.name', "Ballade");
            });
        }
        if($request->has('Vaud')){
            $query->Where('cat_area_id', 1);
        }
        if($request->has('Valais')){
            $query->Where('cat_area_id', 2);
        }
        if($request->has('Fribourg')){
            $query->Where('cat_area_id', 3);
        }
        if($request->has('Bern')){
            $query->Where('cat_area_id', 4);
        }
        if($request->has('Jura')){
            $query->Where('cat_area_id', 5);
        }
        if($request->has('Grisons')){
            $query->Where('cat_area_id', 6);
        }
        if($request->has('Schwytz')){
            $query->Where('cat_area_id', 7);
        }
        if($request->has('France')){
            $query->Where('cat_area_id', 8);
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
        if($request->has('difficile')){
            $query->Where('cat_dogfriendly_id', 3);
        }
        if($request->has('impossible')){
            $query->Where('cat_dogfriendly_id', 4);
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
        $query->orderBy('date', 'desc');
        return view('blog.index', [
            'gpxes' => $query->get(),
            'tags' => Tag::select('id', 'name')->get(),
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'count_posts' => $query->count(),
            'count_total_posts' => Gpx::count(),
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