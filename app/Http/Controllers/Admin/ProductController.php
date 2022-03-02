<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // private ProductInterface $productRepository;

    public function __construct(ProductInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request) 
    {
        $data = $this->productRepository->listAll();
        return view('admin.product.index', compact('data'));
    }

    public function create(Request $request) 
    {
        // $categories = Category::all();
        // $sub_categories = SubCategory::all();
        // $collections = Collection::all();
        $categories = $this->productRepository->categoryList();
        $sub_categories = $this->productRepository->subCategoryList();
        $collections = $this->productRepository->collectionList();
        return view('admin.product.create', compact('categories', 'sub_categories', 'collections'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            "cat_id" => "required|integer",
            "sub_cat_id" => "required|integer",
            "collection_id" => "required|integer",
            "name" => "required|string|max:255",
            "short_desc" => "required",
            "desc" => "required",
            "price" => "required|integer",
            "offer_price" => "required|integer",
            "meta_title" => "required",
            "meta_desc" => "required",
            "meta_keyword" => "required",
            "style_no" => "required",
            "image" => "required",
        ]);

        $params = $request->except('_token');
        $storeData = $this->productRepository->create($params);

        if ($storeData) {
            return redirect()->route('admin.product.index');
        } else {
            return redirect()->route('admin.product.create')->withInput($request->all());
        }
    }

    public function show(Request $request, $id)
    {
        $data = $this->productRepository->listById($id);
        return view('admin.product.detail', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $categories = $this->productRepository->categoryList();
        $sub_categories = $this->productRepository->subCategoryList();
        $collections = $this->productRepository->collectionList();
        $data = $this->productRepository->listById($id);
        return view('admin.product.edit', compact('data', 'categories', 'sub_categories', 'collections'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            "cat_id" => "nullable|integer",
            "sub_cat_id" => "nullable|integer",
            "collection_id" => "nullable|integer",
            "name" => "required|string|max:255",
            "short_desc" => "required",
            "desc" => "required",
            "price" => "required|integer",
            "offer_price" => "required|integer",
            "meta_title" => "required",
            "meta_desc" => "required",
            "meta_keyword" => "required",
            "style_no" => "required",
            "image" => "nullable",
        ]);

        $params = $request->except('_token');
        $storeData = $this->productRepository->update($id, $params);

        if ($storeData) {
            return redirect()->route('admin.product.index');
        } else {
            return redirect()->route('admin.product.create')->withInput($request->all());
        }
    }

    public function status(Request $request, $id)
    {
        $storeData = $this->productRepository->toggle($id);

        if ($storeData) {
            return redirect()->route('admin.product.index');
        } else {
            return redirect()->route('admin.product.create')->withInput($request->all());
        }
    }

    public function destroy(Request $request, $id) 
    {
        $this->productRepository->delete($id);

        return redirect()->route('admin.product.index');
    }
}
