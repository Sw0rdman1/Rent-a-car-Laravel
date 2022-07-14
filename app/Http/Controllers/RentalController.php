<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

use App\Http\Resources\RentalResource;
use App\Http\Resources\RentalCollection;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental::all();
        return new RentalCollection($rentals);
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
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|integer',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $rental = Rental::create([
            'car_id' => $request->car_id,
            'user_id' => Auth::user()->id,
            'rented_at' => $request->rented_at,
            'rented_until' => $request->rented_until,
        ]);

        return response()->json(['Sell is created successfully.', new RentalResource($rental)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
       return new RentalResource($rental);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

            $rental->car_id = $request->car_id;
            $rental->rented_at = $request->rented_at;

            $rental->save();


        return response()->json(['Rental is updated successfully.', new RentalResource($rental)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        return response()->json(['Rental is deleted successfully'],new RentalResource($rental));
    }
}
