<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource; //to ease any change in database names
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ArticleResource::collection(Article::all());
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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required|numeric',
        ]
        );
        $article = Article::create($request->all());
        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = Article::find($id);
        if (! $article) {
            # code...
            return $this->notFound();
        }
        return new ArticleResource($article);
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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required|numeric',
        ]
        );
        $article = Article::find($id);

        if (!$article) {
            # code...
            return $this->notFound();
        }
        $article->update($request->all());
        return new ArticleResource($article);
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
        $article = Article::find($id);

        if (!$article) {
            # code...
            return $this->notFound();
        }
        if($article->delete()){
            return response()->json(['data'=>[], 'status'=>200, 'message'=>'Article Deleted'], 200);
        }else {
            # code...
            return response()->json(['data'=>[], 'status'=>500, 'message'=>'Something went wrong'], 500);
        }
        return $article;
    }

    public function notFound()
    {
        # code...
        $data = [
            'data'=>[],
            'status'=>false,
            'status_code'=>404,
            'message'=>'Article not found, no such article in database'
        ];
        return response()->json($data, 404);
    }
}
