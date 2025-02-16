<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponser;
use App\Http\Requests\Post\CreatePost;
use App\Http\Requests\Post\GetPostsRequest;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\JsonResponse;


class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function get(GetPostsRequest $request): JsonResponse
    {
        $keyword = null;
        $category = null;
        $sortKey = null;

        $request->has('search') ? $keyword = $request->search : null;
        $request->has('cat') ? $category = $request->cat: null;
        $request->has('sort') ? $sortKey = $request->sort : null;

        //dd($keyword, $category, $sortKey);

        $data = $this->postService->retrievePostsByCursor($keyword, $category, $sortKey);
        return ApiResponser::successWithPagination($data, "OK");
    }

    public function create(CreatePost $request)
    {
        $validatedData = $request->validated();

        $post = $this->postService->createPost($validatedData);
        return $post;
    }
}
