<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $size = $request->size ?? 10;
        $order = $request->order != '' ? explode(',', $request->order) : ['id', 'asc'];
        return Category::where('active', '=', true)
            ->orderBy($order[0], $order[1])
            ->paginate($size);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id = null)
    {
        if (!isset($id)) {
            $category = new Category();
            $message = 'created successfully';
            $status = 201;
        } else {
            $category = Category::findOrFail($id);
            $message = 'updated successfully';
            $status = 200;
        }
        $category->fill($request->only([
            'active',
            'name',
        ]));
        $category->save();
        return response()->json(['message' => $message], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        CategoryVideo::query()->where('category_id', $category->id)->delete();
        $category->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function videosCategory(Request $request, int $id)
    {
        $size = $request->size ?? 10;
        $order = $request->order != '' ? explode(',', $request->order) : ['id', 'asc'];
        $category = Category::findOrFail($id);
        return $category
            ->videos()
            ->where('active', true)
            ->with('categories')
            ->orderBy($order[0], $order[1])
            ->paginate($size);
    }
}
