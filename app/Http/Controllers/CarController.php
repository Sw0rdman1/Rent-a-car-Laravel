<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarCollection;

use App\Http\Resources\RentalCollection;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return new CarCollection($cars);
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
            'brand_id' => 'required|integer',
            'reqistration_plate'=> 'required|string',
            'model'=> 'required|string',
            'cubic_capacity'=>'required|integer',
            'horse_powers'=>'required|integer',
            'year_of_production'=>'required|integer'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $car = Car::create([
            'brand_id' => $request->brand_id,
            'reqistration_plate'=> $request->reqistration_plate,
            'model' => $request->model,
            'cubic_capacity' => $request->cubic_capacity,
            'horse_powers' => $request->horse_powers,
            'year_of_production' => $request->year_of_production,
        ]);

        return response()->json(['Car is created successfully.', new CarResource($car)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|integer',
            'reqistration_plate'=> 'required|string',
            'model'=> 'required|string',
            'cubic_capacity'=>'required|integer',
            'horse_powers'=>'required|integer',
            'year_of_production'=>'required|integer'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

            $car->brand_id = $request->brand_id;
            $car->model = $request->model;
            $car->cubic_capacity = $request->cubic_capacity;
            $car->horse_powers = $request->horse_powers;
            $car->reqistration_plate = $request->reqistration_plate;
            $car->year_of_production = $request->year_of_production;

            $car->save();


        return response()->json(['Car is updated successfully.', new CarResource($car)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(['Car deleted',new CarResource($car),'Sells deleted',new RentalController($car->rentals)]);
    }
}
