<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::active()->published()
            ->latest('published_at')->get();

        return view('blog.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->active()->firstOrFail();
        $otherArticles = Article::active()->published()
            ->where('id', '!=', $article->id)
            ->latest('published_at')->take(2)->get();

        return view('blog.show', compact('article', 'otherArticles'));
    }
}
