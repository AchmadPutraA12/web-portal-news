<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestArticle = Article::with('category')->where('is_verified', 1)->latest()->first();

        $categoriesTrending = CategoryArticle::with(['articles' => function ($q) {
            $q->where('is_verified', 1)->latest()->take(1);
        }])->latest()->take(5)->get();

        $categoriesWithArticles = CategoryArticle::with(['articles' => function ($q) {
            $q->where('is_verified', 1)->latest()->take(3);
        }])->latest()->take(5)->get();

        return view('pages.guest.index', compact(
            'latestArticle',
            'categoriesTrending',
            'categoriesWithArticles'
        ));
    }

    public function category($id)
    {
        $category = CategoryArticle::with(['articles' => function ($q) {
            $q->where('is_verified', 1)->latest();
        }])->findOrFail($id);

        return view('pages.guest.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::with('category')->findOrFail($id);

        return view('pages.guest.article-detail', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
