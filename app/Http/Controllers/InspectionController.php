<?php

namespace App\Http\Controllers;

use App\Inspection;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Services\InspectionService;
use App\Services\ConstructionService;
use App\Services\Contracts\InspectionServiceInterface;

class InspectionController extends Controller
{

    protected $inspectionService;
    protected $constructionService;
    protected $imageService;

    protected $s3PathCover = 'images/covers/';

    public function __construct(InspectionServiceInterface $inspectionService,
                                ConstructionService $constructionService,
                                ImageService $imageService)
    {
        $this->inspectionService    = $inspectionService;
        $this->constructionService  = $constructionService;
        $this->imageService         = $imageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inspections = $this->constructionService->constructionWithInspections($request->construction_id);
        return response()->json($inspections, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataFields  = $request->only('inspection');

        $cover = $this->imageService->storeCover($request, $this->s3PathCover);

        $inspection = $this->inspectionService->storeInspection($dataFields, $cover);

        return response()->json($inspection, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        //
    }
}
