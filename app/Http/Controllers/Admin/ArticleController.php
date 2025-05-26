<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\ArticleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $article = Article::all();
            return ArticleDataTable::make($article);
        }

        return view('pages.admin.article.index', [
            'title' => 'Data Article',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $article = Article::where('is_verified', 0)->get();
            return ArticleDataTable::make($article);
        }

        return view('pages.admin.verifikasi.index', [
            'title' => 'Data Article',
        ]);
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
        $validated = $request->validate([
            'category' => 'required|in:1,2,3',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'content_article' => 'required|string',
            'layout' => 'required|in:1,2,3',
            'image_1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $article = new Article($validated);

        if ($request->hasFile('image_1')) {
            $article->image_1 = $request->file('image_1')->store('articles', 'public');
        }

        if ($request->hasFile('image_2')) {
            $article->image_2 = $request->file('image_2')->store('articles', 'public');
        }

        if ($request->hasFile('image_3')) {
            $article->image_3 = $request->file('image_3')->store('articles', 'public');
        }

        $article->is_verified = 0;
        $article->save();

        return response()->json(['message' => 'Artikel berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update2(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->is_verified = 1;
        $article->save();

        return response()->json(['message' => 'Artikel berhasil disetujui']);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'category' => 'required|in:1,2,3',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'content_article' => 'required|string',
            'layout' => 'required|in:1,2,3',
            'image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $validated = $request->validate($rules);

        $article = Article::findOrFail($id);
        $article->fill($validated);

        if ($request->hasFile('image_1')) {
            if ($article->image_1 && Storage::disk('public')->exists($article->image_1)) {
                Storage::disk('public')->delete($article->image_1);
            }
            $article->image_1 = $request->file('image_1')->store('articles', 'public');
        }

        if ($request->hasFile('image_2')) {
            if ($article->image_2 && Storage::disk('public')->exists($article->image_2)) {
                Storage::disk('public')->delete($article->image_2);
            }
            $article->image_2 = $request->file('image_2')->store('articles', 'public');
        }

        if ($request->hasFile('image_3')) {
            if ($article->image_3 && Storage::disk('public')->exists($article->image_3)) {
                Storage::disk('public')->delete($article->image_3);
            }
            $article->image_3 = $request->file('image_3')->store('articles', 'public');
        }

        $article->save();

        return response()->json(['message' => 'Artikel berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article berhasil dihapus.'
        ]);
    }
}
