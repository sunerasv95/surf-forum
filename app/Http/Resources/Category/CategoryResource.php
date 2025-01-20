<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->category_name,
            "slug" => $this->category_slug,
            "sub_categories" => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
