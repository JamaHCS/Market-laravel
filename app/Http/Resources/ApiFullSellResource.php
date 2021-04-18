<?php

namespace App\Http\Resources;

use App\Http\Resources\ApiDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiFullSellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $detailsQuery = $this->sellDetails()->get();
        $details = [];
        $total = 0;

        foreach ($detailsQuery as $detail) {
            array_push($details, new ApiDetailsResource($detail));
            $total += $detail->total;
        }

        return [
            // 'id' => $this->id,
            // 'market' => $this->market()->get()[0],
            // 'user' => $this->user()->get()[0],
            'is_active' =>$this->is_active,
            'details' => $details,
            'total' => $total
        ];
    }
}
