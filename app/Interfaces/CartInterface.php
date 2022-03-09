<?php

namespace App\Interfaces;

interface CartInterface 
{
    public function addToCart(array $data);
    public function viewByIp();
    public function delete($id);
    public function empty();
    public function qtyUpdate($id, $type);
}