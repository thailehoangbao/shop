<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Detail\DetailServices;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    protected $productDetail;

    public function __construct(DetailServices $productDetail)
    {
        $this->productDetail = $productDetail;
    }

    public function store(Product $product)
    {
        $menuname = $this->productDetail->getMenuName($product->menu_id);
        return view('client.detail.detail',[
            'product' => $product,
            'menuname' => $menuname
        ]);
    }

    public function order(Request $request)
    {
        $user_id = auth()->user()->id;
        $result = $this->productDetail->create($request, $user_id);
        if($result === true) {
            return redirect()->back();
        }
    }
}
