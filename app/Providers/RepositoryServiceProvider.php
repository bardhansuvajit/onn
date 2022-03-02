<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\SubcategoryInterface;
use App\Interfaces\CollectionInterface;
use App\Interfaces\CouponInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\ProductInterface;

use App\Repositories\CategoryRepository;
use App\Repositories\SubcategoryRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\CouponRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;

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
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubcategoryInterface::class, SubcategoryRepository::class);
        $this->app->bind(CollectionInterface::class, CollectionRepository::class);
        $this->app->bind(CouponInterface::class, CouponRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
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
