<?php

namespace App\Providers;

use App\Repository\Eloquents\BaseRepository;
use App\Repository\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
    }

    public function boot()
    {

    }
}
