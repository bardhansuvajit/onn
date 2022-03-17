<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\SearchInterface;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function __construct(SearchInterface $searchRepository) 
    {
        $this->searchRepository = $searchRepository;
    }

    public function index(Request $request) 
    {
        $params = $request->except('_token');

        $searchStore = $this->searchRepository->index($params);

        if ($searchStore) {
            return redirect()->back()->with('success', $searchStore);
        } else {
            return redirect()->back()->with('failure', 'Something happened');
        }
    }
}
