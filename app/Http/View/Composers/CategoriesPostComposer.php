<?php

namespace App\Http\View\Composers;

use App\Models\CategoryPost;
use Illuminate\View\View;

class CategoriesPostComposer
{
    public function compose(View $view)
    {
        $categories = CategoryPost::all();
        $view->with('categories', $categories);
    }
}
