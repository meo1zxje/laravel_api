<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = request()->query('q');
        $idSubitem = request()->query('id_subitem'); // Lấy id_subitem từ query params

        $bviets = Article::orderBy('id', 'asc');

        // Lọc theo id_subitem nếu có
        if ($idSubitem) {
            $bviets->where('id_subitem', $idSubitem);
        }

        // Lọc theo từ khóa tìm kiếm (q) nếu có
        if ($q) {
            $bviets->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%') // Tìm kiếm theo title
                    ->orWhere('content', 'like', '%' . $q . '%') // Tìm kiếm theo content
                    ->orWhere('image', 'like', '%' . $q . '%'); // Tìm kiếm theo image
            });
        }

        return response()->json(
            [
                'success' => true,
                'data' => $bviets->paginate(),
                'message' => 'Successfully'
            ]
        );
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
    public function store(ArticleRequest $request)
    {
        $bviet = new Article();
        $bviet->fill($request->all());
        $bviet->save();
        return response()->json(
            [
                'success' => true,
                'data' => $bviet,
                'message' => 'Add Bài viết Successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bviet = Article::find($id);
        if (!$bviet) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Bài viết not found'
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => true,
                'data' => $bviet,
                'message' => 'Find bviet Successfully'
            ]
        );
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
    public function update(ArticleRequest $request, string $id)
    {
        $bviet = Article::find($id);
        if (!$bviet) {
            return response()->json([
                'success' => false,
                'message' => 'Bài viết not found'
            ], 404);
        }

        // Cập nhật chỉ những trường có trong request
        $bviet->fill($request->all());
        $bviet->save();

        return response()->json([
            'success' => true,
            'data' => $bviet,
            'message' => 'Updated Bài viết Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bviet = Article::find($id);
        if (!$bviet) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Bài viết not found'
                ]
            );
        }
        $bviet->delete();
        return response()->json([
            'success' => true,
            'message' => 'Bài viết deleted seccessfully'
        ]);
    }
}
