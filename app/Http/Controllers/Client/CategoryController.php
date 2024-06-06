<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use App\Models\Menu;


class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Menu $menu)
    {
        $categories = $this->categoryService->getListCategory($menu->id);
        return view('client.category.categoryChild',[
            'categories' => $categories,
            'menu' => $menu
        ]);

    }

    public function parentCategory(Menu $menu)
    {
        $products = $this->categoryService->getListParentCategory($menu->id);
        return view('client.category.categoryParent',[
            'products' => $products,
            'menu' => $menu
        ]);
    }
}
