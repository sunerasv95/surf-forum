<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::group("/users", function(){
//     Route::get("/", function(){
//         return "yessss 111";
//     });
// });

// Route::get('/users', function (Request $request) {
//     return "yes";
// });

Route::prefix('posts')->group(function(){
    Route::get("/", [PostController::class, "get"])->name('posts.all');
    //Route::post("/create", [PostController::class, "create"]);
});

Route::prefix('categories')->group(function(){
    Route::get("/", [CategoryController::class, "get"])->name('categories.all');
    //Route::post("/create", [PostController::class, "create"]);
});

Route::prefix('guests')->group(function(){
    Route::post("/register", [AuthController::class, "signup"]);
    Route::post("/login", [AuthController::class, "signin"]);
});
