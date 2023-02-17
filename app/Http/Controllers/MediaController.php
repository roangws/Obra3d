<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Services\Contracts\MediaServiceInterface;

class MediaController extends Controller
{
    protected $mediaService;
    protected $imageService;
    protected $s3PathImage = 'images/inspection/';

    public function __construct(MediaServiceInterface $mediaService,
                                ImageService $imageService)
    {
        $this->mediaService = $mediaService;
        $this->imageService = $imageService;
    }
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
        //dd($request->all());

        $dataFieldsMedia = $request->only('media');

        $image = $this->imageService->storeCover($request, $this->s3PathImage);

        $media = $this->mediaService->storeMedia($dataFieldsMedia);

        return response()->json($media, 201);
    }

    public function storeImageInspection(Request $request){

        $dataFieldsMedia = ($request->only('media'));
        $media = json_decode($dataFieldsMedia['media']);
        

        $image = $this->imageService->storeImageInspection($request, $this->s3PathImage, $media->inspection_id);

        $media = $this->mediaService->storeMedia($dataFieldsMedia);

        return response()->json($media, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
