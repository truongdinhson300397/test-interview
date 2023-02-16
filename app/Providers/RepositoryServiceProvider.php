<?php

namespace App\Providers;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
