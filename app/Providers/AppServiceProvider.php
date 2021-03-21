<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use App\Repositories\CategoryProductRepository;
use App\Repositories\BrandProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;

use App\Repositories\Impl\BrandProductRepositoryImpl;
use App\Repositories\Impl\CategoryProductRepositoryImpl;
use App\Repositories\Impl\ProductRepositoryImpl;
use App\Repositories\Impl\OrderRepositoryImpl;

use App\Services\BrandProductService;
use App\Services\CategoryProductService;
use App\Services\ProductService;
use App\Services\OrderService;

use App\Services\Impl\BrandProductServiceImpl;
use App\Services\Impl\CategoryProductServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use App\Services\Impl\OrderServiceImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(
            CategoryProductRepository::class,
            CategoryProductRepositoryImpl::class
        );
        $this->app->singleton(
            CategoryProductService::class,
            CategoryProductServiceImpl::class
        );

        $this->app->singleton(
            BrandProductRepository::class,
            BrandProductRepositoryImpl::class
        );
        $this->app->singleton(
            BrandProductService::class,
            BrandProductServiceImpl::class
        );

        $this->app->singleton(
            ProductRepository::class,
            ProductRepositoryImpl::class
        );
        $this->app->singleton(
            ProductService::class,
            ProductServiceImpl::class
        );

        
        $this->app->singleton(
            OrderRepository::class,
            OrderRepositoryImpl::class
        );
        $this->app->singleton(
            OrderService::class,
            OrderServiceImpl::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot( )
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
