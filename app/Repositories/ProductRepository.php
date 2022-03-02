<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Collection;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class ProductRepository implements ProductInterface 
{
    use UploadAble;

    public function listAll() 
    {
        return Product::all();
    }

    public function categoryList() 
    {
        return Category::all();
    }

    public function subCategoryList() 
    {
        return SubCategory::all();
    }

    public function collectionList() 
    {
        return Collection::all();
    }

    public function listById($id) 
    {
        return Product::findOrFail($id);
    }

    public function create(array $data) 
    {
        $collectedData = collect($data);
        $newEntry = new Product;
        $newEntry->cat_id = $collectedData['cat_id'];
        $newEntry->sub_cat_id = $collectedData['sub_cat_id'];
        $newEntry->collection_id = $collectedData['collection_id'];
        $newEntry->name = $collectedData['name'];
        $newEntry->short_desc = $collectedData['short_desc'];
        $newEntry->desc = $collectedData['desc'];
        $newEntry->price = $collectedData['price'];
        $newEntry->offer_price = $collectedData['offer_price'];

        // slug generate
        $slug = \Str::slug($collectedData['name'], '-');
        $slugExistCount = Product::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        $newEntry->slug = $slug;
        $newEntry->meta_title = $collectedData['meta_title'];
        $newEntry->meta_desc = $collectedData['meta_desc'];
        $newEntry->meta_keyword = $collectedData['meta_keyword'];
        $newEntry->style_no = $collectedData['style_no'];

        $upload_path = "uploads/product/";
        $image = $collectedData['image'];
        $imageName = time().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $newEntry->image = $upload_path.$uploadedImage;

        $newEntry->save();

        return $newEntry;
    }

    public function update($id, array $newDetails) 
    {
        $updatedEntry = Product::findOrFail($id);
        $collectedData = collect($newDetails); 
        if (!empty($collectedData['cat_id'])) $updatedEntry->cat_id = $collectedData['cat_id'];
        if (!empty($collectedData['sub_cat_id'])) $updatedEntry->sub_cat_id = $collectedData['sub_cat_id'];
        if (!empty($collectedData['collection_id'])) $updatedEntry->collection_id = $collectedData['collection_id'];
        $updatedEntry->name = $collectedData['name'];
        $updatedEntry->short_desc = $collectedData['short_desc'];
        $updatedEntry->desc = $collectedData['desc'];
        $updatedEntry->price = $collectedData['price'];
        $updatedEntry->offer_price = $collectedData['offer_price'];

        // slug generate
        $slug = \Str::slug($collectedData['name'], '-');
        $slugExistCount = Product::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        $updatedEntry->slug = $slug;
        $updatedEntry->meta_title = $collectedData['meta_title'];
        $updatedEntry->meta_desc = $collectedData['meta_desc'];
        $updatedEntry->meta_keyword = $collectedData['meta_keyword'];
        $updatedEntry->style_no = $collectedData['style_no'];

        if (isset($newDetails['image'])) {
            // delete old image
            unlink($updatedEntry->image);

            $upload_path = "uploads/product/";
            $image = $collectedData['image'];
            $imageName = time().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $updatedEntry->image = $upload_path.$uploadedImage;
        }

        $updatedEntry->save();

        return $updatedEntry;
    }

    public function toggle($id){
        $updatedEntry = Product::findOrFail($id);

        $status = ( $updatedEntry->status == 1 ) ? 0 : 1;
        $updatedEntry->status = $status;
        $updatedEntry->save();

        return $updatedEntry;
    }

    public function delete($id) 
    {
        Product::destroy($id);
    }
}