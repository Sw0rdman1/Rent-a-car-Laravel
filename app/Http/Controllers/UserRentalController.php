<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RentalCollection;
use App\Models\Rental;

class UserRentalController extends Controller
{
    public function index($user_id)
    {
        $rentals = Rental::get()-> where('user_id',$user_id);
        if(is_null($rentals)){
            return response()->json('Data not found',404);
        }
        return new RentalCollection($rentals);
    }
}
