<?php

namespace App\Http\Resources;

use App\Http\Resources\ApiProductsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->product()->get()[0];
        $product->image = $product->image()->get()[0]->url;

        return [
            'quant' => $this->quant,
            'total' => $this->total,
            'product' => $product
        ];
    }
}
