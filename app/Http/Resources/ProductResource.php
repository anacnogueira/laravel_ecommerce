<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name'=> $this->name,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'brand_name'  => $this->brand->name,
            'category_name'  => $this->category->name,
            'status' => $this->status,
            'gross_weight' => $this->gross_weight,
            'permalink' => $this->permalink,
            'meta_title' => $this->meta_title,
        ];
    }
}
