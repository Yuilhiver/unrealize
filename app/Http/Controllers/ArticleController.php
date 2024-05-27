<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Articletheme;
use App\Models\User;
use App\Models\Version;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    public function index(){
        $followers_count = User::has('followers')->count();
        $works_count = User::has('works')->count();

        return view('articles', [
            'versions' => Version::with('articles')->withCount('articles')->get()->sortByDesc('articles'),
            'articlethemes' => Articletheme::with('articles')->withCount('articles')->get()->sortByDesc('articles'),
            'followers_count' =>  $followers_count,
            'works_count' =>  $works_count,
        ]);
    }

    public function show(Article $article){
        return view('articles.show', compact('article'));
    }

    public function store(Request $request) {
        $validated = request()->validate( [
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'content' => 'required|min:150|max:25500',
            'articletheme_id' => 'required',
            'version_id' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,webp,bmp|max:10240',
        ]);

        $validated['user_id'] = auth()->id();

        $article = Article::create($validated);

        $article->addMediaFromRequest('image')->usingName('main')
        ->usingFileName(time().'.'.$request['image']->getClientOriginalExtension())
        ->toMediaCollection('articles');

        return redirect()->route('articles.show',$article->id);
    }

    public function destroy(Article $article) {
        Gate::authorize('delete',$article);

        $article->delete();

        return redirect()->route('articles.index');
    }

    public function edit(Article $article){
        Gate::authorize('update',$article);

        $editing = true;

        return view('articles.show',[
            'versions' => Version::all(),
            'articlethemes' => Articletheme::all(),
            'article' => $article,
            'editing' => $editing,
        ]);
    }

    public function update(Article $article){
        Gate::authorize('update',$article);

        $validator = Validator::make(request()->all(), [
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'content' => 'required|min:150|max:25500',
            'articletheme_id' => 'required',
            'version_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $article->update($validated);

        return view('articles.show',compact('article'));
    }
}
