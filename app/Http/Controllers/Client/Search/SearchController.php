<?php

namespace App\Http\Controllers\Client\Search;

use App\Http\Controllers\Controller;
use App\Http\Services\Search\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }


    public function searchProduct(Request $request)
    {
        $products = $this->searchService->searchProduct($request);
        if(!$products){
            return redirect()->back()->with('error', 'Không có sản phẩm nào được tìm kiếm!');
        }
        return view('client.search.layout', compact('products'));
    }
}
