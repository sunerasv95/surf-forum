<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getUsers(): Collection;

    public function findUserById(int $userId): ?User;

    public function findUserByUsername(string $username): ?User;

}
