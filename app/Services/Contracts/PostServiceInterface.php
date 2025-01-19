<?php

namespace App\Services\Contracts;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface PostServiceInterface
{
    public function getAllPosts(): JsonResource;

    public function retrievePostsByCursor(): JsonResource;

    public function findPost(int $postedUser): Collection;

    public function createPost(array $data): Post;


}
