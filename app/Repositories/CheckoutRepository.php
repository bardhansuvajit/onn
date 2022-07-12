<?php

namespace App\Repositories;

use App\Interfaces\CheckoutInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Settings;
use App\Models\Collection;
use App\Models\Transaction;
use App\Models\CouponUsage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
            $coupon_code_id = $cartData[0]->coupon_code_id ?? 0;
            $newEntry->coupon_code_id = $coupon_code_id;
            $newEntry->amount = $subtotal;
            $newEntry->shipping_charges = 0;
            $newEntry->tax_amount = 0;
            // $newEntry->discount_amount = 0;
            // $newEntry->coupon_code_id = 0;
            $total = (int) $subtotal;
            if (!empty($coupon_code_id) || $coupon_code_id != 0) {
				$newEntry->discount_amount = $cartData[0]->couponDetails->amount;
				$newEntry->final_amount = $total - (int) $cartData[0]->couponDetails->amount;
				// $newEntry->final_amount = $total;
				$newEntry->save();
            } else {
                $newEntry->discount_amount = 0;
				$newEntry->final_amount = $total;
				$newEntry->save();
            }

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

            // 3 send product details mail
            $email_data = [
                'name' => $collectedData['fname'].' '.$collectedData['lname'],
                'subject' => 'Onn - New Order',
                'email' => $collectedData['email'],
                'orderId' => $newEntry->id,
                'orderNo' => $order_no,
                'orderAmount' => $total,
                'orderProducts' => $orderProducts,
                'blade_file' => 'front/mail/order-confirm',
            ];

            SendMail($email_data);

            // send invoice mail starts
            $invoice_email_data = [
                'name' => $collectedData['fname'].' '.$collectedData['lname'],
                'subject' => 'Onn - Order Invoice',
                'email' => $collectedData['email'],
                'orderId' => $newEntry->id,
                'orderNo' => $order_no,
                'orderAmount' => $total,
                // 'orderProducts' => $orderProducts,
                'blade_file' => 'front/mail/invoice',
            ];
            SendMail($invoice_email_data);


			// Shiprocket
            $this->shiprocket($newEntry,$cartData);

			// Unicommerce

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
            throw $th;
            dd($th);
            DB::rollback();
            return false;
        }
    }

    public function shiprocket($booking,$items)
    {
        $logindetails = $this->shiprocketlogin();
        $logindetails = json_decode($logindetails);

        $dt = date('Y-m-d H:i:s');

        $pushdata = array();

        foreach($items as $n){
            $data['name'] = $n->product_name;
            $data['sku'] = $n->product_style_no;
            $data['units'] = $n->qty;
            $data['selling_price'] = $n->offer_price;

            array_push($pushdata, $data);
        }

        //$name =  $this->split_name($booking->name);
        $jsondata['order_id'] = $booking->order_no;
        $jsondata['order_date'] = date('Y-m-d H:i:s');
        $jsondata['channel_id'] = '2865152';
        $jsondata['pickup_location'] = 'Lux Dankuni';
        $jsondata['billing_customer_name'] = $booking->fname;
        $jsondata['billing_last_name'] = $booking->lname;
        $jsondata['billing_address'] = $booking->billing_address;
        $jsondata['billing_address_2'] = $booking->billing_landmark;
        $jsondata['billing_city'] = $booking->billing_city;
        $jsondata['billing_pincode'] = $booking->billing_pin;
        $jsondata['billing_state'] = $booking->billing_state;
        $jsondata['billing_country'] = $booking->billing_country;
        $jsondata['billing_email'] = $booking->email;
        $jsondata['billing_phone'] = $booking->mobile;
        $jsondata['shipping_is_billing'] = true;
        $jsondata['shipping_customer_name'] = '';
        $jsondata['shipping_last_name'] = '';
        $jsondata['shipping_address'] = '';
        $jsondata['shipping_address_2'] = '';
        $jsondata['shipping_city'] = '';
        $jsondata['shipping_pincode'] = '';
        $jsondata['shipping_country'] = '';
        $jsondata['shipping_state'] = '';
        $jsondata['shipping_email'] = '';
        $jsondata['shipping_phone'] = '';
        $jsondata['order_items'] = $pushdata;

        $payment_method = '';
        if($booking->payment_method=='online_payment') {
            $payment_method = "Prepaid";
        } else{
			$payment_method = "Cod";
		}

        $jsondata['payment_method'] = $payment_method;
        $jsondata['shipping_charges'] = $booking->shipping_charge;
        $jsondata['total_discount'] = $booking->discount_amount;
        $jsondata['sub_total'] = $booking->final_amount;
        $jsondata['length'] = 10;
        $jsondata['breadth'] = 1;
        $jsondata['height'] = 10;
        $jsondata['weight'] = 5;

        $token = $logindetails->token;

        // echo json_encode($jsondata);

        // die();

        //echo $token;

        $url = 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc';

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ". $token
        );
        //  echo '<pre>';
        //  print_r($headers);
        //  die();
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
        // Execute post
        $result = curl_exec($ch);

        //echo "result : ".$result;
        //die();

        curl_close($ch);

        return $result;

        /*return response()
            ->json(["jsondata"=>$jsondata]);*/
    }

    public function shiprocketlogin()
    {
        $headers = array(
            'Content-Type: application/json'
        );

        $jsondata['email'] = "suvajit.bardhan@onenesstechs.in";
        $jsondata['password'] = "Welcome#2022";

        $url = 'https://apiv2.shiprocket.in/v1/external/auth/login';

        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
        // Execute post
        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

	public function unicommerceLogin()
    {
        $headers = array(
            'Content-Type: application/json'
        );

        $username = "rohit@onenesstechs.in";
        $password = "q%23393KHVqRBPDTE";

        $url = "https://cozyworld.unicommerce.com/oauth/token?grant_type=password&client_id=my-trusted-client&username=".$username."&password=".$password;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);
        return $resp;
    }

    public function split_name($name)
    {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
		return array($first_name, $last_name);
    }
}
