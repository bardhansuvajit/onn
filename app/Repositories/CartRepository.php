<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\ProductColorSize;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function couponCheck($coupon_code)
    {
        $couponData = Coupon::where('coupon_code', $coupon_code)->first();

        if (Auth::guard('web')->user()) {
            $couponUsageCount = CouponUsage::where('user_id', Auth::guard('web')->user()->id)->orWhere('email', Auth::guard('web')->user()->email)->count();
        } else {
            $couponUsageCount = CouponUsage::where('ip', $this->ip)->count();
        }

        if($couponData) {
            if ($couponData->end_date < \Carbon\Carbon::now() || $couponData->status == 0) {
                return response()->json(['resp' => 200, 'type' => 'warning', 'message' => 'Coupon expired']);
            } elseif ($couponUsageCount == $couponData->max_time_one_can_use || $couponUsageCount > $couponData->max_time_one_can_use) {
                return response()->json(['resp' => 200, 'type' => 'warning', 'message' => 'You cannot use this coupon anymore']);
            } else {
                // applied coupon, update in cart
                $cartData = Cart::where('ip', $this->ip)->update(['coupon_code_id' => $couponData->id]);

                return response()->json(['resp' => 200, 'type' => 'success', 'message' => 'Coupon applied', 'id' => $couponData->id, 'amount' => $couponData->amount, 'coupon_discount' => $couponData->amount]);
            }
        }

        return response()->json(['resp' => 200, 'type' => 'error', 'message' => 'Invalid coupon code']);
    }

    public function couponRemove()
    {
        $cartData = Cart::where('ip', $this->ip)->update(['coupon_code_id' => null]);
        return response()->json(['resp' => 200, 'type' => 'success', 'message' => 'Coupon removed']);
    }

    public function addToCart(array $data) 
    {
        $collectedData = collect($data);

        if (!empty($data['product_variation_id'])) {
            $cartExists = Cart::where('product_id', $collectedData['product_id'])->where('product_variation_id', $collectedData['product_variation_id'])->where('ip', $this->ip)->first();

            $variationDetails = ProductColorSize::findOrFail($data['product_variation_id']);
            $productImageDetails = ProductImage::where([['product_id', $variationDetails->product_id], ['color_id', $variationDetails->color]])->first();

            $productImage = $productImageDetails->image;
        } else {
            $cartExists = Cart::where('product_id', $collectedData['product_id'])->where('ip', $this->ip)->first();
            $productImage = $collectedData['product_image'];
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
            $newEntry->product_image = $productImage;
            $newEntry->product_slug = $collectedData['product_slug'];
            $newEntry->product_variation_id = $collectedData['product_variation_id'];

            if (isset($data['product_variation_id'])) {
                $productColorSizeData = ProductColorSize::findOrFail($collectedData['product_variation_id']);
                $newEntry->price = $productColorSizeData->price;
                $newEntry->offer_price = $productColorSizeData->offer_price;
            } else {
                $newEntry->price = $collectedData['price'];
                $newEntry->offer_price = $collectedData['offer_price'];
            }

            $newEntry->qty = $collectedData['qty'];
            $newEntry->ip = $this->ip;

            $newEntry->save();
            return $newEntry;
        }
    }

    public function viewByIp()
    {
        $data = Cart::where('ip', $this->ip)->get();

        // coupon check
        if (!empty($data[0]->coupon_code_id)) {
            $coupon_code_id = $data[0]->coupon_code_id;
            $coupon_code_end_date = $data[0]->couponDetails->end_date;
            $coupon_code_status = $data[0]->couponDetails->status;
            $coupon_code_max_usage_for_one = $data[0]->couponDetails->max_time_one_can_use;

            // coupon code validity check
            if ($coupon_code_end_date < \Carbon\Carbon::now() || $coupon_code_status == 0) {
                Cart::where('ip', $this->ip)->update(['coupon_code_id' => null]);
            }

            // coupon code usage check
            if (Auth::guard('web')->user()) {
                $couponUsageCount = CouponUsage::where('user_id', Auth::guard('web')->user()->id)->orWhere('email', Auth::guard('web')->user()->email)->count();
            } else {
                $couponUsageCount = CouponUsage::where('ip', $this->ip)->count();
            }

            if ($couponUsageCount == $coupon_code_max_usage_for_one || $couponUsageCount > $coupon_code_max_usage_for_one) {
                Cart::where('ip', $this->ip)->update(['coupon_code_id' => null]);
            }
        }

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