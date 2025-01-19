<?php

namespace App\Services;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class PostService implements PostServiceInterface
{
    public function getAllPosts(): JsonResource
    {
        $posts = [];
        $posts = Post::withAuthor()
            ->withCategory()
            ->withCommentsCount()
            ->get();

        return PostResource::collection($posts);
    }


    public function findPost(int $postedUser): Collection
    {
        $posts = [];
        $posts = Post::where('user_id', $postedUser)->limit(10)->get();

        return $posts;
    }

    public function createPost(array $data): Post
    {
        $newPost = new Post();
        $newPost->topic = $data['title'];
        $newPost->post_content = $data['content'];
        $newPost->user_id = $data['posted_by'];
        $newPost->save();

        return $newPost;
    }
}
