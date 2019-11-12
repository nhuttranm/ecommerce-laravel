<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class => CategoryRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind(CategoryContract::class, CategoryRepository::class);
        }
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
