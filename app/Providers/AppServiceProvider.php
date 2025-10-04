<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\RepositoryServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Repository\Interfaces\BaseRepositoryInterface;
use App\Repository\Eloquents\BaseRepository;
use App\Services\HeaderFooterService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->singleton(HeaderFooterService::class, function ($app) {
            return new HeaderFooterService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $like = 'LIKE';
            $this->where(function (Builder $query) use ($attributes, $searchTerm, $like) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm, $like) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm, $like) {
                                $query->where($relationAttribute, $like, "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm, $like) {
                            $query->orWhere($attribute, $like, "%{$searchTerm}%");
                        }
                    );
                }
            });
            return $this;
        });

        View::composer('*', function ($view) {
            $headerFooterService = resolve(HeaderFooterService::class);
            $view->with('siteData', $headerFooterService->getSiteData());
        });
    }
}
