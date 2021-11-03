<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Base\AuthorService;
use App\Services\V1\AuthorManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ApiV1ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthorService::class, AuthorManager::class);
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
