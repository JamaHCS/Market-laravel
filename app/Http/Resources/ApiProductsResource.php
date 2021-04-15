<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'barcode' =>$this->barcode,
            'type' => $this->type,
            'price' => $this->price,
            'cost' => $this->cost,
            'image' => $this->image()->get()[0]->url
        ];
    }
}
