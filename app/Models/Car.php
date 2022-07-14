<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sells()
    {
        return $this->hasMany(Rental::class);
    }
}
