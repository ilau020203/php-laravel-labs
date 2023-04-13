<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::query();
        $query->when($request->filled('name'), function ($q) use ($request) {
            $q->where('name', 'like', $request->name);
        });
        $query->when($request->filled('symbolcode'), function ($q) use ($request) {
            $q->where('symbolcode', 'like', $request->symbolcode);
        });

        $filterParam = $request->filled('tags');

        if ($filterParam) {

            $filteredArticles = Article::whereHas('tags', function ($q) use ($request) {
                $q->where('name', 'like', $request->tags);
            });
            $query = $filteredArticles;
        }

        $articles = $query->paginate(25);

        return view('articles', ['articles' => $articles]);
    }

    public function curArticle($code)
    {
        $arcticle = Article::with("tags")->where('symbolcode', '=', "$code")->firstOrFail();
        return view('curArticle', ['article' => $arcticle]);
    }

}