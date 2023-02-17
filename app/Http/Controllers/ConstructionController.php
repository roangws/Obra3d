<?php

namespace App\Http\Controllers;

use App\Image;
use App\Address;
use App\Construction;
use PHPUnit\Util\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructions = Construction::where('user_id', auth()->user()->id)->with('cover')->get();

        return response()->json($constructions, 200);

    }

    public function all(Request $request)
    {
        $total = isset($request->total) ? $request->total : 10;
        $query = Construction::with(['user', 'address','cover']);
        if (!empty($request->search)){
            $search = $request->search;
            $query->where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
            });
        }

        $constructions =  $query->paginate($total);
        return response()->json($constructions, 200);
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

        /* dd($request->image_file); */
        $dados = json_decode($request->construction);

        $address = json_decode($request->address, true);
        if (isset($address)){
            $address = Address::create($address);
        }

        if ($request->image_file){
            $content = file_get_contents($request->image_file->path());
            $path = 'images/covers/' . auth()->user()->email . "/cover" . $request->image_file->getClientOriginalName();
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
        $construction = new Construction([
            'name' => $dados->name,
            'cover_id' => isset($image->id) ? $image->id : null,
            'description' => $dados->description,
            'company_id' => $dados->company_id,
            'user_id' => $dados->user_id,
            'address_id' => isset($address->id) ? $address->id : null

        ]);
        $construction->save();

        return response()->json($construction, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(Construction $construction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function edit(Construction $construction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Construction $construction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Construction $construction)
    {
        $construction->delete();
        return response()->json([], 200);
    }
}
