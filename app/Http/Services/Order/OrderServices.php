<?php


namespace App\Http\Services\Order;

use App\Events\OrderPlaced;
use App\Models\Order;

class OrderServices
{
    public function create($request, $user_id)
    {
        try {
            $total_price = $request->amount * $request->price_choice;
            $order = new Order();
            $order->product_id = $request->product_id;
            $order->user_id = $user_id;
            $order->amount = $request->amount;
            $order->size = $request->size;
            $order->color = $request->color;
            $order->total_price = $total_price;
            $order->save();
            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    public function delete($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return true;
        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
    }
}
