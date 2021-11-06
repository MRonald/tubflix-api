<?php

namespace App\Http\Controllers;

use App\Models\CategoryVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::query()->where('active', '=', true)->get();
        foreach ($videos as $index => $video) {
            $video['categories'] = $video->getCategories()->get();
            $videos[$index] = $video;
        }
        return $videos;
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
            $categoriesVideo = CategoryVideo::query()->where('video_id', '=', $video->id)->get();
            if ($categoriesVideo) {
                foreach ($categoriesVideo as $categoryVideo) {
                    $categoryVideo->delete();
                }
            }
        }

        // Salvando os relacionamentos da request
        if (count($request->categories) > 0) {
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
        $video = Video::findOrFail($id);
        $video['categories'] = $video->getCategories()->get();
        return $video;
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
        $categoriesVideo = CategoryVideo::query()->where('video_id', '=', $video->id)->get();
        if ($categoriesVideo) {
            foreach ($categoriesVideo as $categoryVideo) {
                $categoryVideo->delete();
            }
        }
        $video->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
