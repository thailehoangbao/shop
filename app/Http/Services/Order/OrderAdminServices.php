<?php


namespace App\Http\Services\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Session as FacadesSession;

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

    public function update($request, Order $order)
    {
        try {
            $order->note = $request->input('note');

            $order->save();
            FacadesSession::flash('success', 'order updated successfully');
            return true;
        } catch (\Exception $err) {
            FacadesSession::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();
            FacadesSession::flash('success', 'order deleted successfully');
            return true;
        } catch (\Exception $err) {
            FacadesSession::flash('error', $err->getMessage());
            return false;
        }
    }
}
