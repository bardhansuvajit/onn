<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\UserInterface;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request) 
    {
        $data = $this->userRepository->listAll();
        return view('admin.customer.index', compact('data'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "email" => "required|string|max:255|unique:users,email",
            "mobile" => "required|integer|digits:10",
            "gender" => "required|string",
            "password" => "required",
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->create($params);

        if ($storeData) {
            return redirect()->route('admin.customer.index');
        } else {
            return redirect()->route('admin.customer.create')->withInput($request->all());
        }
    }

    public function show(Request $request, $id)
    {
        $data = $this->userRepository->listById($id);
        return view('admin.customer.detail', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "mobile" => "required|integer|digits:10",
            "gender" => "nullable|string",
        ]);

        $params = $request->except('_token');
        $storeData = $this->userRepository->update($id, $params);

        if ($storeData) {
            return redirect()->route('admin.customer.index');
        } else {
            return redirect()->route('admin.customer.create')->withInput($request->all());
        }
    }

    public function status(Request $request, $id)
    {
        $storeData = $this->userRepository->toggle($id);

        if ($storeData) {
            return redirect()->route('admin.customer.index');
        } else {
            return redirect()->route('admin.customer.create')->withInput($request->all());
        }
    }

    public function destroy(Request $request, $id) 
    {
        $this->userRepository->delete($id);

        return redirect()->route('admin.customer.index');
    }
}
