<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\CollectionInterface;
use App\Models\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    private CollectionInterface $collectionRepository;

    public function __construct(CollectionInterface $collectionRepository) 
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function index(Request $request) 
    {
        $data = $this->collectionRepository->getAllCollections();
        return view('admin.collection.index', compact('data'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "image_path" => "required|mimes:jpg,jpeg,png,svg,gif|max:10000000"
        ]);

        // generate slug
        $slug = Str::slug($request->name, '-');
        $slugExistCount = Collection::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);

        // $params = $request->only(['name', 'description', 'image_path', 'slug']);
        $params = $request->except('_token');

        $storeData = $this->collectionRepository->createCollection($params);

        if ($storeData) {
            return redirect()->route('admin.collection.index');
        } else {
            return redirect()->route('admin.collection.create')->withInput($request->all());
        }
    }

    public function show(Request $request, $id)
    {
        $data = $this->collectionRepository->getCollectionById($id);
        return view('admin.collection.detail', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "image_path" => "nullable|mimes:jpg,jpeg,png,svg,gif|max:10000000"
        ]);

        // generate slug
        $slug = Str::slug($request->name, '-');
        $slugExistCount = Collection::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);

        $params = $request->except('_token');

        $storeData = $this->collectionRepository->updateCollection($id, $params);

        if ($storeData) {
            return redirect()->route('admin.collection.index');
        } else {
            return redirect()->route('admin.collection.create')->withInput($request->all());
        }
    }

    public function status(Request $request, $id)
    {
        $storeData = $this->collectionRepository->toggleStatus($id);

        if ($storeData) {
            return redirect()->route('admin.collection.index');
        } else {
            return redirect()->route('admin.collection.create')->withInput($request->all());
        }
    }

    public function destroy(Request $request, $id) 
    {
        $this->collectionRepository->deleteCollection($id);

        return redirect()->route('admin.collection.index');
    }
}
