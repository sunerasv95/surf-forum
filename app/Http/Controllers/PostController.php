<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponser;
use App\Http\Requests\Post\CreatePost;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\JsonResponse;


class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function get(): JsonResponse
    {
        $data = $this->postService->retrievePostsByCursor();
        return ApiResponser::successWithPagination($data, "OK");
    }

    public function create(CreatePost $request)
    {
        $validatedData = $request->validated();

        $post = $this->postService->createPost($validatedData);
        return $post;
    }
}
