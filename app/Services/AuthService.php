<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Error;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class AuthService implements AuthServiceInterface
{
    private $userService;

    function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function registerUser(array $userData)
    {
        $user = new User();
        $user->name = $userData["full_name"];
        $user->email = $userData["email"];
        $user->password = Hash::make($userData["password"]);
        $user->save();

        return $user;

    }

    public function authenticateUser(array $credentials)
    {
        $username = $credentials["username"];
        $password = $credentials["password"];

        $user = $this->userService->findUserByUsername($username);

        if(!$user || !Hash::check($password, $user->password)) {
            return Error("credentials are not matched!"); //to-do:proper error handling
        }

        //return $user->createToken
    }

    private function generateToken()
    {

    }
}
