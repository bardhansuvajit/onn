<?php

namespace App\Repositories;

use App\Interfaces\CheckoutInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Transaction;
use App\Models\CouponUsage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutRepository implements CheckoutInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function viewCart()
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

    public function addressData()
    {
        return Address::where('user_id', Auth::guard('web')->user()->id)->get();
    }

    public function create(array $data)
    {
        $collectedData = collect($data);

        DB::beginTransaction();

        try {
            // 1 order
            $order_no = "ONN".mt_rand();
            $newEntry = new Order;
            $newEntry->order_no = $order_no;
            $newEntry->user_id = Auth::guard('web')->user()->id ?? 0;
            $newEntry->ip = $this->ip;
            $newEntry->email = $collectedData['email'];
            $newEntry->mobile = $collectedData['mobile'];
            $newEntry->fname = $collectedData['fname'];
            $newEntry->lname = $collectedData['lname'];
            $newEntry->billing_country = $collectedData['billing_country'];
            $newEntry->billing_address = $collectedData['billing_address'];
            $newEntry->billing_landmark = $collectedData['billing_landmark'];
            $newEntry->billing_city = $collectedData['billing_city'];
            $newEntry->billing_state = $collectedData['billing_state'];
            $newEntry->billing_pin = $collectedData['billing_pin'];

            // shipping & billing address check
            $shippingSameAsBilling = $collectedData['shippingSameAsBilling'] ?? 0;
            $newEntry->shippingSameAsBilling = $shippingSameAsBilling;

            // dd($shippingSameAsBilling);

            if ($shippingSameAsBilling == 0) {
                $newEntry->shipping_country = $collectedData['shipping_country'];
                $newEntry->shipping_address = $collectedData['shipping_address'];
                $newEntry->shipping_landmark = $collectedData['shipping_landmark'];
                $newEntry->shipping_city = $collectedData['shipping_city'];
                $newEntry->shipping_state = $collectedData['shipping_state'];
                $newEntry->shipping_pin = $collectedData['shipping_pin'];
            } else {
                $newEntry->shipping_country = $collectedData['billing_country'];
                $newEntry->shipping_address = $collectedData['billing_address'];
                $newEntry->shipping_landmark = $collectedData['billing_landmark'];
                $newEntry->shipping_city = $collectedData['billing_city'];
                $newEntry->shipping_state = $collectedData['billing_state'];
                $newEntry->shipping_pin = $collectedData['billing_pin'];
            }

            $newEntry->shipping_method = $collectedData['shipping_method'];

            // fetch cart details
            $cartData = Cart::where('ip', $this->ip)->get();
            $subtotal = 0;
            foreach($cartData as $cartValue) {
                $subtotal += $cartValue->offer_price * $cartValue->qty;
            }
            $newEntry->amount = $subtotal;
            $newEntry->shipping_charges = 0;
            $newEntry->tax_amount = 0;
            // $newEntry->discount_amount = 0;
            // $newEntry->coupon_code_id = 0;
            $total = (int) $subtotal;
            $newEntry->final_amount = $total;
            $coupon_code_id = $cartData[0]->coupon_code_id ?? 0;
            $newEntry->coupon_code_id = $coupon_code_id;
            $newEntry->save();

            // coupon code usage handler
            if (!empty($coupon_code_id) || $coupon_code_id != 0) {
                $newEntry->discount_amount = $cartData[0]->couponDetails->amount;
                $newEntry->final_amount = $total - (int) $cartData[0]->couponDetails->amount;

                // update coupon code usage
                $couponDetails = Coupon::findOrFail($coupon_code_id);
                $old_no_of_usage = $couponDetails->no_of_usage;
                $new_no_of_usage = $old_no_of_usage + 1;
                $couponDetails->no_of_usage = $new_no_of_usage;
                if ($new_no_of_usage == $couponDetails->max_time_of_use) $couponDetails->status = 0;
                $couponDetails->save();

                $newCouponUsageEntry = new CouponUsage();
                $newCouponUsageEntry->coupon_code_id = $coupon_code_id;
                $newCouponUsageEntry->coupon_code = $couponDetails->coupon_code;
                $newCouponUsageEntry->discount = $cartData[0]->couponDetails->amount;
                $newCouponUsageEntry->total_checkout_amount = $total;
                $newCouponUsageEntry->final_amount = $total - (int) $cartData[0]->couponDetails->amount;
                $newCouponUsageEntry->user_id = Auth::guard('web')->user()->id ?? 0;
                $newCouponUsageEntry->email = $collectedData['email'];
                $newCouponUsageEntry->ip = $this->ip;
                $newCouponUsageEntry->order_id = $newEntry->id;
                $newCouponUsageEntry->usage_time = date('Y-m-d H:i:s');
                $newCouponUsageEntry->save();
            }

            // 2 insert cart data into order products
            $orderProducts = [];
            foreach($cartData as $cartValue) {
                $orderProducts[] = [
                    'order_id' => $newEntry->id,
                    'product_id' => $cartValue->product_id,
                    'product_name' => $cartValue->product_name,
                    'product_image' => $cartValue->product_image,
                    'product_slug' => $cartValue->product_slug,
                    'product_variation_id' => $cartValue->product_variation_id,
                    'price' => $cartValue->price,
                    'offer_price' => $cartValue->offer_price,
                    'qty' => $cartValue->qty,
                ];
            }
            $orderProductsNewEntry = OrderProduct::insert($orderProducts);

            // 3 send mail
            $email_data = [
                'name' => $collectedData['fname'].' '.$collectedData['lname'],
                'subject' => 'Onn - New order',
                'email' => $collectedData['email'],
                'orderNo' => $order_no,
                'orderAmount' => $total,
                'orderProducts' => $orderProducts,
                'blade_file' => 'front/mail/order-confirm',
            ];

            SendMail($email_data);

            // 4 remove cart data
            $emptyCart = Cart::where('ip', $this->ip)->delete();

            // 5 online payment
            if (isset($data['razorpay_payment_id'])) {
                $txnData = new Transaction();
                $txnData->user_id = Auth::guard('web')->user()->id ?? 0;
                $txnData->order_id = $newEntry->id;
                $txnData->transaction = 'TXN_'.strtoupper(Str::random(20));
                $txnData->online_payment_id = $collectedData['razorpay_payment_id'];
                $txnData->amount = $total;
                $txnData->currency = "INR";
                $txnData->method = "";
                $txnData->description = "";
                $txnData->bank = "";
                $txnData->upi = "";
                $txnData->save();
            }

            DB::commit();
            return $order_no;
        } catch (\Throwable $th) {
            // throw $th;
            // dd($th);
            DB::rollback();
            return false;
        }
    }
}