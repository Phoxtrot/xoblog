<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Cookie;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = Article::where('published',1)->latest()->take(3)->get();
        $allfeatured = Article::where('published',1)->orderBy('created_at', "DESC")->take(10)->get();
        $allPost = Article::where('published',1)->latest()->paginate(10);

        $random = Article::where('published',1)->inRandomOrder()->take(4)->get();

        return view('welcome',compact(['featured','random','allfeatured','allPost']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {
        $featured = Article::where('published',1)->latest()->take(3)->get();
        $allPost = Article::where('published',1)->latest()->paginate(10);
        $cookieName = (Str::replace('.','',($request->ip())).'-'. $article->id); //Setting Cookie Name
        if (Cookie::get($cookieName)=='') {
            $cookie = cookie($cookieName, '1', 60);//set the cookie
            $article->incrementViewCount();
          
            return response()->view('show', compact(['article','featured','allPost']))->withCookie($cookie);
        } else {
            return view('show', compact(['article','featured','allPost']));
        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
