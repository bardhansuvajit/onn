<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Interfaces\OrderInterface;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(UserInterface $userRepository, OrderInterface $orderRepository)
    {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    public function login(Request $request)
    {
        $recommendedProducts = $this->userRepository->recommendedProducts();
        return view('front.auth.login', compact('recommendedProducts'));
    }

    public function register(Request $request)
    {
        $recommendedProducts = $this->userRepository->recommendedProducts();
        return view('front.auth.register', compact('recommendedProducts'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|integer|digits:10|unique:users,mobile',
            'password' => 'required|string|min:2|max:100',
        ]);

        $storeData = $this->userRepository->create($request->except('_token'));

        if ($storeData) {
            // $credentials = $request->only('email', 'password');

            // if (Auth::attempt($credentials)) {
            //     // return redirect()->intended('home');
            //     return redirect()->url('home');
            // }

            return redirect()->route('front.user.login')->with('success', 'Account created successfully');
        } else {
            return redirect()->route('front.user.register')->withInput($request->all())->with('failure', 'Something happened');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:2|max:100',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
            // return redirect()->url('home');
        } else {
            return redirect()->route('front.user.login')->withInput($request->all());
        }
    }

    public function order(Request $request)
    {
        $data = $this->userRepository->orderDetails();
        return view('front.profile.order', compact('data'));
    }

    public function coupon(Request $request)
    {
        $data = $this->userRepository->couponList();
        return view('front.profile.coupon', compact('data'));
    }

    public function address(Request $request)
    {
        $data = $this->userRepository->addressById(Auth::guard('web')->user()->id);
        if ($data) {
            return view('front.profile.address', compact('data'));
        } else {
            return view('front.404');
        }
    }

    public function addressCreate(Request $request)
    {
        $request->validate([
            "user_id" => "required|integer",
            "address" => "required|string|max:255",
            "landmark" => "required|string|max:255",
            "lat" => "required",
            "lng" => "required",
            "type" => "required|integer",
            "state" => "required|string",
            "city" => "required|string",
            "country" => "required|string",
            "pin" => "required|integer|digits:6",
            "type" => "required|integer",
        ], [
            "lat.*" => "Please enter Location",
            "lng.*" => "Please enter Location"
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->addressCreate($params);

        if ($storeData) {
            return redirect()->route('front.user.address');
        } else {
            return redirect()->route('front.user.address.add')->withInput($request->all());
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "mobile" => "required|integer|digits:10",
        ], [
            "mobile.*" => "Please enter a valid 10 digit mobile number"
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->updateProfile($params);

        if ($storeData) {
            return redirect()->route('front.user.manage')->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('front.user.manage')->withInput($request->all())->with('failure', 'Something happened. Try again');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "old_password" => "required|string|max:255",
            "new_password" => "required|string|max:255|same:confirm_password",
            "confirm_password" => "required|string|max:255",
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->updatePassword($params);

        if ($storeData) {
            return redirect()->route('front.user.manage')->with('success', 'Password updated successfully');
        } else {
            return redirect()->route('front.user.manage')->withInput($request->all())->with('failure', 'Something happened');
        }
    }

    public function wishlist(Request $request)
    {
        $data = $this->userRepository->wishlist();
        if ($data) {
            return view('front.profile.wishlist', compact('data'));
        } else {
            return view('front.404');
        }
    }

    public function invoice(Request $request, $id)
    {
        $data = $this->orderRepository->listById($id);
        return view('front.profile.invoice', compact('data'));
    }
}
