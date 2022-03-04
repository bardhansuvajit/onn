<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\SettingsInterface;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function __construct(SettingsInterface $settingsRepository) 
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function index(Request $request) 
    {
        $data = $this->settingsRepository->listAll();
        return view('admin.settings.index', compact('data'));
    }

    public function show(Request $request, $id)
    {
        $data = $this->settingsRepository->listById($id);
        return view('admin.settings.detail', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "content" => "required|string"
        ]);

        $params = $request->except('_token');
        $storeData = $this->settingsRepository->update($id, $params);

        if ($storeData) {
            return redirect()->route('admin.settings.index');
        } else {
            return redirect()->route('admin.settings.create')->withInput($request->all());
        }
    }
}
