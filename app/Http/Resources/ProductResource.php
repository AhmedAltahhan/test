<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        if($this->is_active == 1)
            $is_active = 'active';
        else
        $is_active = 'not active';

        // modify product data to a specified formal
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description'=> $this->description,
            'image' => $this->getFirstMediaUrl('image'),
            'slug' => $this->slug,
            'price' => $this->price,
            'is_active' => $is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        return $data;
    }
}
