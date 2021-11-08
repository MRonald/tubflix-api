<?php

namespace App\Http\Controllers;

use App\Models\CategoryVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use stdClass;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Video::where('active', '=', true)->with('categories')->paginate($request->size);
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
            $video = new Video();
            $message = 'created successfully';
            $status = 201;
        } else {
            $video = Video::findOrFail($id);
            $message = 'updated successfully';
            $status = 200;
        }
        $video->fill($request->only([
            'active',
            'title',
            'description',
            'url_featured_image',
            'url_thumbnail_image',
            'url_video',
        ]));

        $video->save();

        // Caso seja atualização exclui relacionamentos anteriores
        if ($status == 200) {
            CategoryVideo::query()->where('video_id', '=', $video->id)->delete();
        }

        // Salvando os relacionamentos da request
        if ($request->categories) {
            foreach ($request->categories as $categoryVideo) {
                CategoryVideo::create([
                    'video_id' => $video->id,
                    'category_id' => $categoryVideo,
                ]);
            }
        }

        return response()->json(['message' => $message], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Video::findOrFail($id)->with('categories')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $video = Video::findOrFail($id);
        CategoryVideo::query()->where('video_id', '=', $video->id)->delete();
        $video->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
