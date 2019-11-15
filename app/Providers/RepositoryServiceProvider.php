<?php

namespace App\Providers;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\MessageRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\MessageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            MessageRepositoryInterface::class,
            MessageRepository::class
        );
    }
}
