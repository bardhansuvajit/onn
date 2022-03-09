<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function detail(Request $request, $slug)
    {
        $data = $this->categoryRepository->getCategoryBySlug($slug);
        $sizes = $this->categoryRepository->getAllSizes();
        $colors = $this->categoryRepository->getAllColors();

        if ($data) {
            return view('front.category.detail', compact('data', 'sizes', 'colors'));
        } else {
            return view('front.404');
        }
    }
}
