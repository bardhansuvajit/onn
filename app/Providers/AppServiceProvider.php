<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\CategoryParent;
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
                $categories = Category::with('parentCatDetails')->orderBy('parent', 'asc')->orderBy('position', 'asc')->where('status', 1)->get();

                $categoryNavList = [];

                foreach ($categories as $catKey => $catValue) {
                    // if (in_array_r($catValue->parent, $categoryNavList)) continue;
                    if (in_array_r($catValue->parentCatDetails->name, $categoryNavList)) continue;

                    $childCategories = Category::select('slug', 'name', 'sketch_icon', 'image_path')->where('parent', $catValue->parent)->orderBy('position', 'asc')->get()->toArray();

                    $categoryNavList[] = [
                        'parent' => $catValue->parentCatDetails->name,
                        // 'parent' => $catValue->parent,
                        // 'parent' => $categoryParent->name,
                        'child' => $childCategories
                    ];
                }
            }

            // dd($categoryNavList);

            // collections
            $collectionExists = Schema::hasTable('collections');
            if ($collectionExists) {
                $collections = Collection::orderBy('position', 'asc')->orderBy('id', 'desc')->where('status', 1)->get();
            }

            // settings
            $settingsExists = Schema::hasTable('settings');
            if ($settingsExists) {
                $settings = Settings::where('status', 1)->get();
            }

            // cart count
            $cartExists = Schema::hasTable('carts');
            if ($cartExists) {
                $cartCount = Cart::where('ip', $ip)->get();

                $totalCartProducts = 0;
                foreach($cartCount as $cartKey => $cartVal) {
                    $totalCartProducts += $cartVal->qty;
                }
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
            view()->share('cartCount', $totalCartProducts);
            view()->share('wishlistCount', $wishlistCount);
        });
    }
}
