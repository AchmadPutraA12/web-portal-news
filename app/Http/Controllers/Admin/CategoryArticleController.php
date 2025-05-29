<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\CategoryArticleDataTable;
use App\Http\Controllers\Controller;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categoryArticle = CategoryArticle::all();
            return CategoryArticleDataTable::make($categoryArticle);
        }

        return view('pages.admin.category_article.index', [
            'title' => 'Data Catgoery Article',
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
            'name'     => 'required|string|max:255',
        ]);

        $categoryArticle = CategoryArticle::create([
            'name'     => $validated['name'],
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.',
            'data'    => $categoryArticle
        ]);
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
    public function update(Request $request, $id)
    {
        $categoryArtcile = CategoryArticle::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
        ]);

        $categoryArtcile->name     = $validated['name'];
        $categoryArtcile->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Category Article berhasil diperbarui.',
            'data'    => $categoryArtcile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryArtcile = CategoryArticle::findOrFail($id);

        $categoryArtcile->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ]);
    }
}
