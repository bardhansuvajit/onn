<?php

namespace App\Repositories;

use App\Interfaces\SearchInterface;
use App\Models\Product;

class SearchRepository implements SearchInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function index(array $data) 
    {
        $collectedData = collect($data);

        $data = Product::where('name', 'like', '%'.$collectedData['query'].'%')
        ->orWhere('slug', 'like', '%'.$collectedData['query'].'%')
        ->orWhere('style_no', 'like', '%'.$collectedData['query'].'%')
        ->orWhere('short_desc', 'like', '%'.$collectedData['query'].'%')
        ->orWhere('desc', 'like', '%'.$collectedData['query'].'%')
        ->get();

        return $data;
    }
}