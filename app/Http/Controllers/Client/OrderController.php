<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateFormRequest;
use App\Http\Services\Order\OrderServices;
use App\Models\Order;
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
}
