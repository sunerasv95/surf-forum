<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->topic,
            "author" => $this->user->name,
            "kind" => $this->category->category_name,
            "tags" => $this->tags,
            "interactions" => [
                "views_counts" => $this->view_count,
                "total_replies" => $this->comments_count
            ],
            "posted_at" => $this->created_at->diffForHumans()
        ];
    }
}
