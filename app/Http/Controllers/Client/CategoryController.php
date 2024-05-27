<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use App\Models\Menu;

use Illuminate\Http\Request;

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
        return view('client.category.layout',[
            'categories' => $categories,
            'menu' => $menu
        ]);
    }
}
