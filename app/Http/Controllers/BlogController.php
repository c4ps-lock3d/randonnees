<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FormPostRequest;
use App\Models\CatArea;
use App\Models\CatDifficulty;
use App\Models\CatDogfriendly;
use App\Models\CatLayout;
use App\Models\CatTopography;

class BlogController extends Controller
{
    // Welcome
    public function welcome(): View{
        return view('blog.welcome', [
            'last_posts' => Post::get()->sortByDesc("date")->skip(0)->take(3),
            'count_posts' => Post::count(),
            'sum_distance' => Post::get()->sum('distance')
        ]); 
    }
    
    // Afficher et trier
    public function index(Request $request): View{
        $query = Post::get()->sortByDesc("date");
        if($request->has('triDistEffDesc')){
            $query = Post::get()->sortByDesc("distEff");
        }
        if($request->has('triDistEffAsc')){
            $query = Post::get()->sortBy("distEff");
        }
        return view('blog.index', [
            'posts' => $query
        ]);  
    }

    public function show(string $slug, Post $post):RedirectResponse | View{
        // Inutile grâce au Model Binding --> $post = Post::findOrFail($post);
        if($post->slug != $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('blog.show',[
            'post' => $post
        ]);
    }
    
    // Créer
    public function create(){
        return view('blog.create', [
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_topographies' => CatTopography::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function store(FormPostRequest $request){
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "Bravo, la randonnée a été créée.");
    }

    // Editer
    public function edit(Post $post){
        return view('blog.edit',[
            'post' => $post,
            'cat_areas' => CatArea::select('id', 'name')->get(),
            'cat_layouts' => CatLayout::select('id', 'name')->get(),
            'cat_topographies' => CatTopography::select('id', 'name')->get(),
            'cat_difficulties' => CatDifficulty::select('id', 'name')->get(),
            'cat_dogfriendlies' => CatDogfriendly::select('id', 'name')->get()
        ]);
    }
    public function update(Post $post, FormPostRequest $request){
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "Bravo, la randonnée a été modifiée.");
    }

    // Pages uniques
    public function about(): View{
        return view('blog.about');
    }

    public function corse2023(): View{
        return view('blog.corse2023');
    }
}