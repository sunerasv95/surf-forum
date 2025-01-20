<?php

namespace App\Services\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface CategoryServiceInterface
{
    public function getAllCategories();
    // public function getParentCategories(): Collection;

    // public function getChildCategories(int $parentId): Collection;

    // public function findUserById(int $userId): ?User;

    // public function findUserByUsername(string $username): ?User;

}
