<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'Rental';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'user'=>new UserResource($this->resource->user),
            'car'=>new CarResource($this->resource->car),
            'rented_at'=>$this->resource->rented_at,
        ];
    }
}
