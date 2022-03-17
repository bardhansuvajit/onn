<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionMail;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Gallery;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::latest('id')->get();
        $collections = Collection::latest('id')->get();
        $products = Product::latest('is_trending', 'id')->get();
        $galleries = Gallery::latest('id')->get();
        return view('front.welcome', compact('category', 'collections', 'products', 'galleries'));
    }

    public function mailSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscription_mails'
        ]);

        $mail = new SubscriptionMail();
        $mail->email = $request->email;
        $mail->save();

        return redirect()->back()->with('mailSuccess', 'Mail subscribed successfully');
    }
}
