<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(UserInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|integer|digits:10|unique:users,mobile',
            'password' => 'required|string|min:2|max:100',
        ]);

        $storeData = $this->userRepository->create($request->except('_token'));

        if ($storeData) {
            $credentials = $request->only('email', 'password');
 
            if (Auth::attempt($credentials)) {
                // return redirect()->intended('home');
                return redirect()->url('home');
            }
            // return redirect()->route('front.user.register');
        } else {
            return redirect()->route('front.user.register')->withInput($request->all());
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
        return view('front.profile.coupon');
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
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->updateProfile($params);

        if ($storeData) {
            return redirect()->route('front.user.manage');
        } else {
            return redirect()->route('front.user.manage')->withInput($request->all());
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
}
