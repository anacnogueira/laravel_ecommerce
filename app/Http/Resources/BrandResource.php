<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'image' => $this->image,
            'short_description' => $this->short_description,
            'text' =>  $this->text,
            'permalink_old' => $this->permalink_old,
            'permalink' => $this->permalink,
        ];
    }
}
