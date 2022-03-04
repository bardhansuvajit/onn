<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\SubcategoryInterface;
use App\Interfaces\CollectionInterface;
use App\Interfaces\CouponInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\FaqInterface;
use App\Interfaces\SettingsInterface;

use App\Repositories\CategoryRepository;
use App\Repositories\SubcategoryRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\CouponRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\AddressRepository;
use App\Repositories\FaqRepository;
use App\Repositories\SettingsRepository;

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
        $this->app->bind(AddressInterface::class, AddressRepository::class);
        $this->app->bind(FaqInterface::class, FaqRepository::class);
        $this->app->bind(SettingsInterface::class, SettingsRepository::class);
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
