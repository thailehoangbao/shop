<?php

namespace App\Http\Services\Search;

use App\Models\Product;

class SearchService
{
    public function searchProduct($request)
    {
        try {
            $products = Product::where('name', 'like', '%' . $request->keyword . '%')
            ->orWhere('price', 'like', '%' . $request->keyword . '%')
            ->orWhere('description', 'like', '%' . $request->keyword . '%')
            ->get();
            return $products;
        } catch (\Exception $e) {
            return false;
        }


    }
}
