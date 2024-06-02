<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateFormRequest;
use App\Http\Services\Order\OrderServices;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderServices $order)
    {
        $this->order = $order;
    }
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $result = $this->order->create($request, $user_id);
        if($result === true) {
            return redirect()->back();
        }
    }

    public function destroy( Request $request )
    {
        $result = $this->order->delete($request->id);
        if($result === true) {
            return redirect()->back();
        }
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->with('product')->get();
        return view('client.order.order', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::where('id', $id)->with('product')->first();
        // Kiểm tra nếu người dùng yêu cầu PDF
        if (request('pdf', true)) {
            $pdf = PDF::loadView('pdf.order_detail', compact('order'));
            return $pdf->stream('order_detail.pdf');
        }
    }
}
