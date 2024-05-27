<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;
use App\Models\Product;
use Illuminate\View\View;

class ProductComposer
{
    public function __construct(public Product $products) {

    }

    public function compose(View $view)
    {
        $products = Product::where('active',1)->orderByDesc('id')->get();
        // Truyền dữ liệu vào view composer
        $view->with('products',$products);
    }
}
