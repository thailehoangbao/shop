<?php


namespace App\Http\Services\Order;

use App\Models\Order;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderServices {
    public function create ($request, $user_id) {
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
