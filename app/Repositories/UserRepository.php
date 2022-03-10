<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\User;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface 
{
    public function __construct() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

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
        $newEntry->fname = $collectedData['fname'] ?? NULL;
        $newEntry->lname = $collectedData['lname'] ?? NULL;
        $newEntry->email = $collectedData['email'];
        $newEntry->mobile = $collectedData['mobile'];
        $newEntry->gender = $collectedData['gender'] ?? NULL;
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

    public function addressById($id) 
    {
        return Address::where('user_id', $id)->get();
    }

    public function addressCreate(array $data) 
    {
        $collectedData = collect($data);
        $newEntry = new Address;
        $newEntry->user_id = $collectedData['user_id'];
        $newEntry->address = $collectedData['address'];
        $newEntry->landmark = $collectedData['landmark'];
        $newEntry->lat = $collectedData['lat'];
        $newEntry->lng = $collectedData['lng'];
        $newEntry->state = $collectedData['state'];
        $newEntry->city = $collectedData['city'];
        $newEntry->pin = $collectedData['pin'];
        $newEntry->pin = $collectedData['pin'];
        $newEntry->country = $collectedData['country'];
        $newEntry->save();

        return $newEntry;
    }

    public function updateProfile(array $data) 
    {
        $collectedData = collect($data);
        $updateEntry = User::findOrFail(Auth::guard('web')->user()->id);
        $updateEntry->fname = $collectedData['fname'];
        $updateEntry->lname = $collectedData['lname'];
        $updateEntry->name = $collectedData['fname'].' '.$collectedData['lname'];
        $updateEntry->save();

        return $updateEntry;
    }

    public function updatePassword(array $data) 
    {
        $collectedData = collect($data);
        $userExists = User::findOrFail(Auth::guard('web')->user()->id);

        if ($userExists) {
            if (Hash::check($collectedData['old_password'], $userExists->password)) {
                $userExists->password = Hash::make($collectedData['new_password']);
                $userExists->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function orderDetails() 
    {
        $data = Order::where('user_id', Auth::guard('web')->user()->id)->orWhere('ip', $this->ip)->latest('id')->get();
        return $data;
    }

    public function recommendedProducts() 
    {
        $data = Product::latest('is_best_seller', 'id')->get();
        return $data;
    }
}