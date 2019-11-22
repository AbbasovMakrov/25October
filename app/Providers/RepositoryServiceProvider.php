<?php

namespace App\Providers;

use App\Interfaces\MessageRepositoryInterface;
use App\Repositories\MessageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array $repositories
     * @usage 'App\Interfaces\Interface' => 'App\Repositories\Class'
     */
    private $repositories = [
        MessageRepositoryInterface::class => MessageRepository::class
    ];

    /**
     * Registering the repositories
     * @return void
     */
    private function registerRepositories()
    {
        foreach ($this->repositories as $repositoryInterface => $repositoryClass) {
            $this->app->bind($repositoryInterface,$repositoryClass);
        }
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRepositories();
    }
}
