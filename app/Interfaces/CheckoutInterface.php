<?php

namespace App\Interfaces;

interface CheckoutInterface 
{
    public function viewCart();
    public function addressData();
    public function couponCheck($coupon_code);
    public function create(array $data);
}