<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    // use Notifiable;

    protected $fillable = ['name', 'description', 'image_path', 'banner_image', 'slug'];

    public function ProductDetails(string $orderBy = 'id', string $order = 'desc') {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->orderBy($orderBy, $order);
    }
}
