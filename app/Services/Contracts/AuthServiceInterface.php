<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function registerUser(array $userData);

    public function authenticateUser(array $credentials);
}
