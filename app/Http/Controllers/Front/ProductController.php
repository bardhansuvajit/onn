<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductImage;

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
        $wishlistCheck = $this->productRepository->wishlistCheck($data->id);
        $primaryColorSizes = $this->productRepository->primaryColorSizes($data->id);

        if ($data) {
            return view('front.product.detail', compact('data', 'images', 'relatedProducts', 'wishlistCheck', 'primaryColorSizes'));
        } else {
            return view('front.404');
        }
    }

    public function size(Request $request)
    {
        $productId = $request->productId;
        $colorId = $request->colorId;

        $data = ProductColorSize::where('product_id', $productId)->where('color', $colorId)->orderBy('id')->get();
        $dataImage = ProductImage::where('product_id', $productId)->where('color_id', $colorId)->orderBy('id')->get();

        $resp = [];

        foreach ($data as $dataKey => $dataValue) {
            $resp[] = [
                'variationId' => $dataValue->id,
                'sizeId' => $dataValue->size,
                'sizeName' => $dataValue->sizeDetails->name,
                'price' => $dataValue->price,
                'offerPrice' => $dataValue->offer_price,
            ];
        }

        $respImage = [];

        foreach ($dataImage as $dataKey => $dataValue) {
            $respImage[] = [
                'image' => asset($dataValue->image),
            ];
        }

        return response()->json(['error' => false, 'data' => $resp, 'images' => $respImage]);
    }
}
