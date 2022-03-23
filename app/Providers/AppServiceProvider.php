<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Settings;
use App\Models\Cart;
use App\Models\Wishlist;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view::composer('*', function($view) {
            $ip = $_SERVER['REMOTE_ADDR'];

            // categories
            $categoryExists = Schema::hasTable('categories');
            if ($categoryExists) {
                $categories = Category::latest('id')->where('status', 1)->get();

                $categoryNavList = [];

                foreach ($categories as $catKey => $catValue) {
                    if (in_array_r($catValue->parent, $categoryNavList)) continue;

                    $childCategories = Category::select('slug', 'name', 'sketch_icon')->where('parent', $catValue->parent)->get()->toArray();

                    $categoryNavList[] = [
                        'parent' => $catValue->parent,
                        'child' => $childCategories
                    ];
                }
            }

            // collections
            $collectionExists = Schema::hasTable('collections');
            if ($collectionExists) {
                $collections = Collection::latest('id')->where('status', 1)->get();
            }

            // settings
            $settingsExists = Schema::hasTable('settings');
            if ($settingsExists) {
                $settings = Settings::where('status', 1)->get();
            }

            // cart count
            $cartExists = Schema::hasTable('carts');
            if ($cartExists) {
                $cartCount = Cart::where('ip', $ip)->count();
            }

            // wishlist count
            $wishlistExists = Schema::hasTable('wishlists');
            if ($wishlistExists) {
                $wishlistCount = Wishlist::where('ip', $ip)->count();
            }

            view()->share('categories', $categories);
            view()->share('categoryNavList', $categoryNavList);
            view()->share('collections', $collections);
            view()->share('settings', $settings);
            view()->share('cartCount', $cartCount);
            view()->share('wishlistCount', $wishlistCount);
        });
    }
}
