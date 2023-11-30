<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;

class BlogController extends Controller
{
    // Afficher
    public function index(): View{
        //$triDistance = Post::all(['id', 'slug','title', 'eleAsc', 'distance', 'date'])->sortBy("distance");
        return view('blog.index', [
            'posts' => Post::all(['id', 'slug','title', 'eleAsc', 'distance', 'date'])
        ]);  
        // Permet de récupérer seulement certains éléments (filtrer)
        // $posts = \App\Models\Post::where('id', '>', 0)->limit(2)->get();
        // return $posts;
    }
    //public function indexTriDistance(): View{
    //   // Permet de récupérer l'ensemble des articles
    //  return view('blog.index', [
    //      'posts' => Post::all(['id', 'slug','title', 'eleAsc', 'distance', 'date'])->sortBy("distance")
    //    ]);
    //}
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
        return view('blog.create');
    }
    public function store(FormPostRequest $request){
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "Bravo, la randonnée a été créée.");
    }

    // Editer
    public function edit(Post $post){
        return view('blog.edit',[
            'post' => $post
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
        return view('blog.corse-2023');
    }
}