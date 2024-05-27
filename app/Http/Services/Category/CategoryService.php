<?php

namespace App\Http\Services\Category;

use App\Models\Product;

class CategoryService
{
    public function __construct()
    {

    }


    public function getListCategory($category_id)
    {
        return Product::where('menu_id', $category_id)->get();
    }
}
