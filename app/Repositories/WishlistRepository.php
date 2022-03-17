<?php

namespace App\Repositories;

use App\Interfaces\WishlistInterface;
use App\Models\Wishlist;

class WishlistRepository implements WishlistInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function addToWishlist(array $data) 
    {
        $collectedData = collect($data);

        $wishlistExists = Wishlist::where('product_id', $collectedData['product_id'])->where('ip', $this->ip)->first();

        if ($wishlistExists) {
            $newEntry = Wishlist::destroy($wishlistExists->id);
            return "Product removed from wishlist";
        } else {
            $newEntry = new Wishlist;
            $newEntry->product_id = $collectedData['product_id'];
            $newEntry->ip = $this->ip;

            $newEntry->save();
            return "Product wishlisted";
        }
    }

    // public function viewByIp()
    // {
    //     $data = Wishlist::where('ip', $this->ip)->get();
    //     return $data;
    // }

    // public function delete($id)
    // {
    //     $data = Wishlist::destroy($id);
    //     return $data;
    // }

    // public function empty()
    // {
    //     $data = Wishlist::where('ip', $this->ip)->delete();
    //     return $data;
    // }
}