<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class CategoryRepository implements CategoryInterface 
{
    use UploadAble;

    public function getAllCategories() 
    {
        return Category::all();
    }

    public function getCategoryById($categoryId) 
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteCategory($categoryId) 
    {
        Category::destroy($categoryId);
    }

    public function createCategory(array $categoryDetails) 
    {
        $collection = collect($categoryDetails);

        $category = new Category;
        $category->name = $collection['name'];
        $category->description = $collection['description'];
        $category->slug = $collection['slug'];

        $upload_path = "uploads/category/";
        $image = $collection['image_path'];
        $imageName = time().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $category->image_path = $upload_path.$uploadedImage;

        $category->save();

        return $category;
    }

    public function updateCategory($categoryId, array $newDetails) 
    {
        $category = Category::findOrFail($categoryId);
        $collection = collect($newDetails); 
        // dd($newDetails);

        $category->name = $collection['name'];
        $category->description = $collection['description'];
        $category->slug = $collection['slug'];

        if (in_array('image_path', $newDetails)) {
            // dd('here');
            $upload_path = "uploads/category/";
            $image = $collection['image_path'];
            $imageName = time().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $category->image_path = $upload_path.$uploadedImage;
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
}