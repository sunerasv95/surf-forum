<?php

namespace App\Services\Contracts;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

interface PostServiceInterface
{
    public function getAllPosts(): JsonResource;

    public function findPost(int $postedUser): Collection;

    public function createPost(array $data): Post;
}
