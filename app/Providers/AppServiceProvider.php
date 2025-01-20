<?php

namespace App\Providers;

use App\Auth\Models\AccessToken as SanctumAccessToken;
use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\PostServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sanctum::usePersonalAccessTokenModel(SanctumAccessToken::class);
        JsonResource::withoutWrapping();
        ResourceCollection::withoutWrapping();

        Relation::enforceMorphMap(([
            'post' => 'App\Models\Post'
        ]));
    }
}
