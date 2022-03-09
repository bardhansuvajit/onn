<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(ProductInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function detail(Request $request, $slug)
    {
        $data = $this->productRepository->listBySlug($slug);
        $images = $this->productRepository->listImagesById($data->id);
        $relatedProducts = $this->productRepository->relatedProducts($data->id);
        // $sizes = $this->productRepository->getAllSizes();
        // $colors = $this->productRepository->getAllColors();

        if ($data) {
            return view('front.product.detail', compact('data', 'images', 'relatedProducts'));
        } else {
            return view('front.404');
        }
    }
}
