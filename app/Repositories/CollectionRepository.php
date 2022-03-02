<?php

namespace App\Repositories;

use App\Interfaces\CollectionInterface;
use App\Models\Collection;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class CollectionRepository implements CollectionInterface 
{
    use UploadAble;

    public function getAllCollections() 
    {
        return Collection::all();
    }

    public function getCollectionById($collectionId) 
    {
        return Collection::findOrFail($collectionId);
    }

    public function deleteCollection($collectionId) 
    {
        Collection::destroy($collectionId);
    }

    public function createCollection(array $data) 
    {
        $collection = collect($data);

        $modelDetails = new Collection;
        $modelDetails->name = $collection['name'];
        $modelDetails->description = $collection['description'];
        $modelDetails->slug = $collection['slug'];

        $upload_path = "uploads/collection/";
        $image = $collection['image_path'];
        $imageName = time().".".$image->getClientOriginalName();
        $image->move($upload_path, $imageName);
        $uploadedImage = $imageName;
        $modelDetails->image_path = $upload_path.$uploadedImage;

        $modelDetails->save();

        return $modelDetails;
    }

    public function updateCollection($id, array $newDetails) 
    {
        $modelDetails = Collection::findOrFail($id);
        $collection = collect($newDetails); 
        // dd($newDetails);

        $modelDetails->name = $collection['name'];
        $modelDetails->description = $collection['description'];
        $modelDetails->slug = $collection['slug'];

        if (in_array('image_path', $newDetails)) {
            // dd('here');
            $upload_path = "uploads/collection/";
            $image = $collection['image_path'];
            $imageName = time().".".$image->getClientOriginalName();
            $image->move($upload_path, $imageName);
            $uploadedImage = $imageName;
            $modelDetails->image_path = $upload_path.$uploadedImage;
        }
        // dd('outside');

        $modelDetails->save();

        return $modelDetails;
    }

    public function toggleStatus($id){
        $collection = Collection::findOrFail($id);

        $status = ( $collection->status == 1 ) ? 0 : 1;
        $collection->status = $status;
        $collection->save();

        return $collection;
    }
}