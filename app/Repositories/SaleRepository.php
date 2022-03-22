<?php

namespace App\Repositories;

use App\Interfaces\SaleInterface;
use App\Models\Product;

class SaleRepository implements SaleInterface 
{
    public function listAll() 
    {
        return Product::limit(4)->get();
    }
}