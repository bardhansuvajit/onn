<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface 
{
    public function listAll() 
    {
        return User::all();
    }

    public function listById($id) 
    {
        return User::findOrFail($id);
    }

    public function create(array $data) 
    {
        $collectedData = collect($data);
        $newEntry = new User;
        $newEntry->fname = $collectedData['fname'];
        $newEntry->lname = $collectedData['lname'];
        $newEntry->email = $collectedData['email'];
        $newEntry->mobile = $collectedData['mobile'];
        $newEntry->gender = $collectedData['gender'];
        $newEntry->password = Hash::make($collectedData['password']);

        // $upload_path = "uploads/collection/";
        // $image = $collectedData['image_path'];
        // $imageName = time().".".$image->getClientOriginalName();
        // $image->move($upload_path, $imageName);
        // $uploadedImage = $imageName;
        // $newEntry->image_path = $upload_path.$uploadedImage;

        $newEntry->save();

        return $newEntry;
    }

    public function update($id, array $newDetails) 
    {
        $updatedEntry = User::findOrFail($id);
        $collectedData = collect($newDetails); 
        $updatedEntry->fname = $collectedData['fname'];
        $updatedEntry->lname = $collectedData['lname'];
        $updatedEntry->mobile = $collectedData['mobile'];
        if (!empty($collectedData['gender'])) {
            $updatedEntry->gender = $collectedData['gender'];
        }
        $updatedEntry->save();

        return $updatedEntry;
    }

    public function toggle($id){
        $updatedEntry = User::findOrFail($id);

        $status = ( $updatedEntry->status == 1 ) ? 0 : 1;
        $updatedEntry->status = $status;
        $updatedEntry->save();

        return $updatedEntry;
    }

    public function delete($id) 
    {
        User::destroy($id);
    }
}