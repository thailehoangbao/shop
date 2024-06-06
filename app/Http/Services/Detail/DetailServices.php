<?php


namespace App\Http\Services\Detail;

use App\Models\Order;
use App\Models\Product;

class DetailServices
{
    public function getMenuName($menu_id) {
        return Product::where('menu_id', $menu_id)->with('menu')->first()->menu->name;
    }

    public function create($request, $user_id) {
        try {
            $order = new Order();
            $order->product_id = $request->product_id;
            $order->user_id = $user_id;
            $order->amount = $request->amount;
            $order->size = $request->size;
            $order->color = $request->color;
            $order->save();
            return true;
        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
    }
}
