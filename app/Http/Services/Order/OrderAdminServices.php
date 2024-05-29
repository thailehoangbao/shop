<?php


namespace App\Http\Services\Order;

use App\Models\Order;

class OrderAdminServices {

    public function getAll()
    {
        $orders = Order::with(['user', 'product'])->paginate(5);
        return $orders;
    }

    public function getOne(Order $order)
    {
        $orders = Order::with(['user', 'product'])->find($order->id);
        return $orders;
    }
}
