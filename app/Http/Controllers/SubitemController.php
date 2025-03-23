<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubitemRequest;
use App\Models\Subitem;
use Illuminate\Http\Request;

class SubitemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = request()->query('q');
        $idCategory = request()->query('id_category');
        $subs = Subitem::orderBy('id', 'asc');

        if ($idCategory) {
            $subs->where('id_category', $idCategory);
        }

        if ($q) {
            $subs->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            });
        }
        return response()->json(
            [
                'success' => true,
                'data' => $subs->paginate(),
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
    public function store(SubitemRequest $request)
    {
        $sub = new Subitem();
        $sub->fill($request->all());
        $sub->save();
        return response()->json(
            [
                'success' => true,
                'data' => $sub,
                'message' => 'Add Subitem Successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sub = Subitem::find($id);
        if (!$sub) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Subitem not found'
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => true,
                'data' => $sub,
                'message' => 'Find Subitem Successfully'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subitem $subitem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubitemRequest $request, $id)
    {
        $sub = Subitem::find($id);
        if (!$sub) {
            return response()->json([
                'success' => false,
                'message' => 'Subitem not found'
            ], 404);
        }

        // Cập nhật chỉ những trường có trong request
        $sub->fill($request->all());
        $sub->save();

        return response()->json([
            'success' => true,
            'data' => $sub,
            'message' => 'Updated Subitem Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub = Subitem::find($id);
        if (!$sub) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Subitem not found'
                ]
            );
        }
        $sub->delete();
        return response()->json([
            'success' => true,
            'message' => 'Subitem deleted seccessfully'
        ]);
    }
}
