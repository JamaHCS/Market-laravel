<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiSellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = 0;

        foreach ($this->sellDetails()->get() as $sell) {
            $total += $sell->total;
        }

        return [
            'id' => $this->id,
            'market' => $this->market()->get()[0],
            'user' => $this->user()->get()[0],
            'is_active' =>$this->is_active,
            'details' => $this->sellDetails()->get(),
            'total' => $total
        ];
    }
}
