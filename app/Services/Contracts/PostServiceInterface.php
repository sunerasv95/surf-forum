<?php

namespace App\Services\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostServiceInterface
{
    public function getAllPosts(): Collection;
    
    public function getPosts(int $postedUser): Collection;

    public function createPost(array $data): Post;
}
