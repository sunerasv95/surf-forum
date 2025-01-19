<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponser;
use App\Http\Requests\Post\CreatePost;
use App\Http\Resources\Post\PostResource;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function get()
    {
        $posts = $this->postService->getAllPosts();
        return ApiResponser::success($posts, "OK");
    }

    public function create(CreatePost $request)
    {
        $validatedData = $request->validated();

        $post = $this->postService->createPost($validatedData);
        return $post;
    }
}
