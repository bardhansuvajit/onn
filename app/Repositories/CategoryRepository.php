<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use DB;

class CategoryRepository implements CategoryInterface 
{
    use UploadAble;

    public function getAllCategories() 
    {
        return Category::all();
    }

    public function getAllSizes() 
    {
        return Size::all();
    }

    public function getAllColors() 
    {
        return Color::all();
    }

    public function getCategoryById($categoryId) 
    {
        return Category::findOrFail($categoryId);
    }

    public function getCategoryBySlug($slug) 
    {
        return Category::where('slug', $slug)->with('ProductDetails')->first();
    }

    public function deleteCategory($categoryId) 
    {
        Category::destroy($categoryId);
    }

    public function createCategory(array $categoryDetails) 
    {
        $upload_path = "uploads/category/";
        $collection = collect($categoryDetails);

        $category = new Category;
        $category->name = $collection['name'];
        $category->parent = $collection['parent'];
        $category->description = $collection['description'];

        // generate slug
        $slug = Str::slug($collection['name'], '-');
        $slugExistCount = Category::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;

        // icon image
        $image = $collection['icon_path'];
        $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $category->icon_path = $upload_path.$uploadedImage;

        // sketch icon
        $image = $collection['sketch_icon'];
        $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $category->sketch_icon = $upload_path.$uploadedImage;

        // thumb image
        $image = $collection['image_path'];
        $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $category->image_path = $upload_path.$uploadedImage;

        // banner image
        $bannerImage = $collection['banner_image'];
        $bannerImageName = time().".".mt_rand().".".$bannerImage->getClientOriginalName();
        $bannerImage->move($upload_path, $bannerImageName);
        $uploadedImage = $bannerImageName;
        $category->banner_image = $upload_path.$uploadedImage;

        $category->save();

        return $category;
    }

    public function updateCategory($categoryId, array $newDetails) 
    {
        $upload_path = "uploads/category/";
        $category = Category::findOrFail($categoryId);
        $collection = collect($newDetails); 

        $category->name = $collection['name'];
        $category->parent = $collection['parent'];
        $category->description = $collection['description'];

        // generate slug
        $slug = Str::slug($collection['name'], '-');
        $slugExistCount = Category::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;

        if (isset($newDetails['icon_path'])) {
            // dd('here');
            $image = $collection['icon_path'];
            $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $category->icon_path = $upload_path.$uploadedImage;
        }

        if (isset($newDetails['sketch_icon'])) {
            // dd('here');
            $image = $collection['sketch_icon'];
            $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $category->sketch_icon = $upload_path.$uploadedImage;
        }

        if (isset($newDetails['image_path'])) {
            // dd('here');
            $image = $collection['image_path'];
            $imageName = time().".".mt_rand().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $category->image_path = $upload_path.$uploadedImage;
        }

        if (isset($newDetails['banner_image'])) {
            // dd('here');
            $bannerImage = $collection['banner_image'];
            $bannerImageName = time().".".mt_rand().".".$bannerImage->getClientOriginalName();
            $bannerImage->move($upload_path, $bannerImageName);
            $uploadedImage = $bannerImageName;
            $category->banner_image = $upload_path.$uploadedImage;
        }
        // dd('outside');

        $category->save();

        return $category;
    }

    public function toggleStatus($id){
        $category = Category::findOrFail($id);

        $status = ( $category->status == 1 ) ? 0 : 1;
        $category->status = $status;
        $category->save();

        return $category;
    }

    public function productsByCategory(int $categoryId, array $filter = null) {
        try {
            $productsQuery = Product::where('cat_id', $categoryId);
            // $productsQuery = DB::statement('SELECT * FROM `products` WHERE cat_id = '.$categoryId);

            // handling collection
            if (isset($filter['collection'])) {
                foreach ($filter['collection'] as $collectionKey => $collectionValue) {
                    // if (count($filter['collection']) == 1) {
                    //     $products = $productsQuery->where('collection_id', $collectionValue);
                    // } else {
                        // $rawQuery = "(collection_id = '.$collectionValue.' OR )";
                        $products = $productsQuery->where(function($query) {
                            $query->orWhere('collection_id', $collectionValue);
                        });
                    // }
                }
                // $products = $productsQuery->whereRaw("'".$rawQuery."'");
            }

            // handling sort by
            if (isset($filter['orderBy'])) {
                $orderBy = "id"; $order = "desc";

                if ($filter['orderBy'] == "new_arr") {
                    $orderBy = "id"; $order = "desc";
                } elseif ($filter['orderBy'] == "mst_viw") {
                    $orderBy = "view_count"; $order = "desc";
                } elseif ($filter['orderBy'] == "prc_low") {
                    $orderBy = "offer_price"; $order = "asc";
                } elseif ($filter['orderBy'] == "prc_hig") {
                    $orderBy = "offer_price"; $order = "desc";
                }

                $products = $productsQuery->orderBy($orderBy, $order);
            }

            $products = $productsQuery->with('colorSize')->get();

            $response = [];
            foreach ($products as $productKey => $productValue) {
                if (count($productValue->colorSize) > 0) {
                    $varArray = [];
                    foreach($productValue->colorSize as $productVariationKey => $productVariationValue) {
                        $varArray[] = $productVariationValue->offer_price;
                    }
                    $bigger = $varArray[0];
                    for ($i = 1; $i < count($varArray); $i++) {
                        if ($bigger < $varArray[$i]) {
                            $bigger = $varArray[$i];
                        }
                    }

                    $smaller = $varArray[0];
                    for ($i = 1; $i < count($varArray); $i++) {
                        if ($smaller > $varArray[$i]) {
                            $smaller = $varArray[$i];
                        }
                    }

                    $displayPrice = $smaller.' - '.$bigger;

                    if ($smaller == $bigger) $displayPrice = $smaller;
                    $show_price = $displayPrice;
                } else {
                    $show_price = $productValue['offer_price'];
                }

                $response[] = [
                    'name' => $productValue['name'],
                    'slug' => $productValue['slug'],
                    'image' => $productValue['image'],
                    'styleNo' => $productValue['style_no'],
                    'displayPrice' => $show_price,
                ];
            }

            return $response;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}