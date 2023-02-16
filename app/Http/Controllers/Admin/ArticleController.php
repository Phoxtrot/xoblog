<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\articleRequest;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view ('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view ('admin.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(articleRequest $request)
    {


        $file = $request->file('image');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        Article::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$filename,
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->category_id,
            'published'=>$request->has('published')?1:0,
            'featured'=>$request->has('featured')?1:0,
            'trending'=>$request->has('trending')?1:0,
            'slug' => SlugService::createSlug(Article::class, 'slug', $request->title),
        ]);
        return redirect()->route('article.index')->with('message', 'Article created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view ('admin.article.edit',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'=> 'required',
            'image'=> 'mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id'=>'required',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $article->update([
                'title'=>$request->title,
                'body'=>$request->body,
                'image'=>$filename,
                'user_id'=>auth()->user()->id,
                'category_id'=>$request->category_id,
                'published'=>$request->has('published')?1:0,
                'featured'=>$request->has('featured')?1:0,
                'trending'=>$request->has('trending')?1:0,
            ]);
        }
        $article->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->category_id,
            'published'=>$request->has('published')?1:0,
            'featured'=>$request->has('featured')?1:0,
            'trending'=>$request->has('trending')?1:0,
        ]);
        return redirect()->route('article.index')->with('message', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index')->with('message', 'Article deleted successfully');
    }
}
