<?php

namespace App\Http\Controllers;

use App\AppConfig;
use Illuminate\Http\Request;
use App\Services\AppConfigService;

class AppConfigController extends Controller
{

    protected $service;

    public function __construct(AppConfigService $service)
    {
        $this->service = $service;
    }

    public function welcomeVideo(){
        $welcomeUrl = $this->service->welcomeUrl();
        return response()->json($welcomeUrl, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = $this->service->lastConfig();
        return response()->json($configs, 200);
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
        $appConfig = $this->service->store($request->all());
        return response()->json($appConfig, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function show(AppConfig $appConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(AppConfig $appConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppConfig $appConfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppConfig $appConfig)
    {
        //
    }
}
