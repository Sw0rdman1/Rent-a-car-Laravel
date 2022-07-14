<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'Car';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'brand'=>new BrandResource($this->resource->brand),
            'model'=>$this->resource->model,
            'year_of_production'=>$this->resource->year_of_production,
            'cubic_capacity'=>$this->resource->cubic_capacity,
            'horse_powers'=>$this->resource->horse_powers,
        ];
    }
}
