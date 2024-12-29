<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{
    public function getUsers(): Collection
    {
        $users = [];
        $users = User::all();

        return $users;
    }

    public function findUserById(int $userId): ?User
    {
        $user = User::find($userId);

        return $user;
    }

    public function findUserByUsername(string $username): ?User
    {
        $user = User::where("email", $username)->first();

        return $user;
    }

    // public function createPost(array $data): Post
    // {
    //     $newPost = new Post();
    //     $newPost->topic = $data['title'];
    //     $newPost->post_content = $data['content'];
    //     $newPost->user_id = $data['posted_by'];
    //     $newPost->save();

    //     return $newPost;
    // }
}
