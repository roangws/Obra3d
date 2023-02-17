<?php

namespace App\Http\Controllers;

use App\Image;
use App\Video;
use App\Construction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = json_decode($request->video);
        if ($request->image_file){
            $content = file_get_contents($request->image_file->path());
            $path = 'images/playlist/' . auth()->user()->email . "/cover" . $request->image_file->getClientOriginalName();
            $conditional = Storage::disk('s3')->put($path, $content);
            if ($conditional) {
                Storage::disk('s3')->setVisibility($path, 'public');
                $image = new Image();
                $image->path = $path;
                $image->title = "cover";
                $image->size = $request->image_file->getSize();
                $image->save();

            }
        }


        if (isset($image)){
            $dados->cover_id = $image->id;
        }
        $video = Video::create((array)($dados));
        return response()->json($video, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
