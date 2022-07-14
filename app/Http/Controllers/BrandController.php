<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarCollection;
use App\Http\Resources\BrandCollection;
use Illuminate\Support\Facades\Validator;
use App\Rules\isCountry;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return new BrandCollection($brands);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country' => ['required', 'string',  new isCountry],
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $brand = Brand::create([
            'name' => $request->name,
            'country' => $request->country,


            
        ]);

        return response()->json(['Brand is created successfully.', new BrandResource($brand)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country' => ['required', 'string',  new isCountry],
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

            $brand->name = $request->name;
            $brand->country = $request->country;

        

        return response()->json(['Brand is updated successfully.', new BrandResource($brand)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['Brand deleted',new BrandResource($brand),'Cars deleted',new CarCollection($brand->cars)]);
    }
}
