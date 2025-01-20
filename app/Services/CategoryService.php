<?php

namespace App\Services;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryService implements CategoryServiceInterface
{

    public function getAllCategories()
    {
        $categories = [];
        $categories = Category::withChildren()->active()->get();
        //return $categories;
        return CategoryResource::collection($categories);
    }

    // public function retrieveParentCategories(): Collection
    // {
    //     $categories = [];
    //     $categories = Category::query()->active();

    //     return $categories;
    // }

    // public function retrieveChildCategories(int $parentId): Collection
    // {
    //     $categories = [];
    //     $categories = Category::query()->where('parent_id', $parentId)->active()->get();

    //     return $categories;
    // }

}
