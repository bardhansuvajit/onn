<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    protected $fillable = ['coupon_code_id', 'coupon_code', 'discount', 'total_checkout_amount', 'final_amount', 'user_id', 'email', 'ip', 'order_id', 'usage_time'];
}
