<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\Coupon;

class CartRepository implements CartInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function couponCheck($coupon_code)
    {
        $data = Coupon::where('coupon_code', $coupon_code)->first();

        if($data) {
            if ($data->end_date < \Carbon\Carbon::now()) {
                return response()->json(['resp' => 200, 'type' => 'warning', 'message' => 'Coupon expired']);
            } else {
                // $cartData = Cart::where('ip', $this->ip)->get();
                // $cartData->

                return response()->json(['resp' => 200, 'type' => 'success', 'message' => 'Coupon applied', 'id' => $data->id, 'amount' => $data->amount]);
            }
        }

        return response()->json(['resp' => 200, 'type' => 'error', 'message' => 'Invalid coupon code']);
        // return $resp;
    }

    public function addToCart(array $data) 
    {
        $collectedData = collect($data);

        if (!empty($data['product_variation_id'])) {
            $cartExists = Cart::where('product_id', $collectedData['product_id'])->where('product_variation_id', $collectedData['product_variation_id'])->where('ip', $this->ip)->first();
        } else {
            $cartExists = Cart::where('product_id', $collectedData['product_id'])->where('ip', $this->ip)->first();
        }

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
            if ($qty == 1) {$resp = 'Minimum quantity is 1';return $resp;}
            $updatedQty = $qty-1;
        }
        $cartData->qty = $updatedQty;
        $cartData->save();
        $resp = 'Cart updated';
        return $resp;
    }
}