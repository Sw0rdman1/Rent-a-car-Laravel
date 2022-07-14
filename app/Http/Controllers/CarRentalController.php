<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RentalCollection;
use App\Models\Rental;

class CarRentalController extends Controller
{
    public function index($car_id)
    {
        $rentals = Rental::get()-> where('car_id',$car_id);
        if(is_null($rentals)){
            return response()->json('Data not found',404);
        }
        return new RentalCollection($rentals);
    }
}
