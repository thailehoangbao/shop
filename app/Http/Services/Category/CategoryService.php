<?php

namespace App\Http\Services\Category;

use App\Models\Menu;
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

    public function getListParentCategory($menu_id)
    {
        $menuChild = Menu::where('parent_id', $menu_id)->get();
        $products = collect(); // Sử dụng collection để dễ dàng merge kết quả
        foreach ($menuChild as $menu) {
            $menuProducts = Product::where('menu_id', $menu->id)->get();
            $products = $products->merge($menuProducts); // Merge các sản phẩm vào collection
        }
        return $products;
    }
}
