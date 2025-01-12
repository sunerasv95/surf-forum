<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class PostService implements PostServiceInterface
{
    public function getAllPosts(): Collection
    {
        $posts = [];
        $posts = Post::query()->with('author', 'category')->get();

        return $posts;
    }


    public function getPosts(int $postedUser): Collection
    {
        $posts = [];
        $posts = Post::where('author_id', $postedUser)->limit(10)->get();

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
