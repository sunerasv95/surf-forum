<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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
    Route::get("/all", [PostController::class, "get"]);
    Route::post("/create", [PostController::class, "create"]);
});
