<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::all();
        if ($comment->count()>0) {
            return $comment;
        } else {
            return "No comments";
        }

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
        $article = Article::where('id', $request->article)->first();


        $validate = $request->validate([
            'name' => 'required|max:255',
            'message'=> 'required',
            'email'=> 'required',
        ]);
        if ($validate) {
            $article->comment()->create([
                'name' => $request->name,
                'message' => $request->message,
                'email' => $request->email,
                'website' => $request->website,
            ]);
            return 'success';
            // $result = $article->comment;
            // $output = "";
            // if ($result->count()>0) {
            //     foreach ($result as $key) {
            //         $output.='<div class="media mb-4">

            //         <div class="media-body">
            //             <h6><a class="text-secondary font-weight-bold" href="">'.$key->name.'</a> <small><i>'.\Carbon\Carbon::parse( $key->created_at )->diffForHumans().'</i></small></h6>
            //             <p>'.$key->message.'</p>
            //         </div>
            //     </div>';
            //     }
            // } else {
            //     $output .= "No Comment Available";
            // }

            // return $output;
        } else {
            return "Something went wrong";
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
