<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;

class CartRepository implements CartInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function addToCart(array $data) 
    {
        // dd($data);
        $collectedData = collect($data);

        $cartExists = Cart::where('product_id', $collectedData['product_id'])->where('ip', $this->ip)->first();

        if ($cartExists) {
            $cartExists->qty = $cartExists->qty + 1;
            $cartExists->save();
            return $cartExists;
        } else {
            $newEntry = new Cart;
            $newEntry->product_id = $collectedData['product_id'];
            $newEntry->product_name = $collectedData['product_name'];
            $newEntry->product_style_no = $collectedData['product_style_no'];
            $newEntry->product_image = $collectedData['product_image'];
            $newEntry->product_slug = $collectedData['product_slug'];
            $newEntry->product_variation_id = $collectedData['product_variation_id'];
            $newEntry->price = $collectedData['price'];
            $newEntry->offer_price = $collectedData['offer_price'];
            $newEntry->qty = $collectedData['qty'];
            $newEntry->ip = $this->ip;

            $newEntry->save();
            return $newEntry;
        }
    }

    public function viewByIp()
    {
        $data = Cart::where('ip', $this->ip)->get();
        return $data;
    }

    public function delete($id)
    {
        $data = Cart::destroy($id);
        return $data;
    }

    public function empty()
    {
        $data = Cart::where('ip', $this->ip)->delete();
        return $data;
    }

    public function qtyUpdate($id, $type) {
        $cartData = Cart::findOrFail($id);
        $qty = $cartData->qty;
        if ($type == 'incr') {
            $updatedQty = $qty+1;
        } else {
            if ($qty == 1) return false;
            $updatedQty = $qty-1;
        }
        $cartData->qty = $updatedQty;
        $resp = $cartData->save();
        return $resp;
    }
}