<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponser;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get()
    {
        $data = $this->categoryService->getAllCategories();
        return ApiResponser::success($data, "OK");
    }
}
