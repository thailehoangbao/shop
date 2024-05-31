<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateFormRequest;
use App\Http\Services\Order\OrderAdminServices;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $orderServices;

    public function __construct(OrderAdminServices $orderServices)
    {
        $this->orderServices = $orderServices;
    }

    public function index()
    {
        $orders = $this->orderServices->getAll();
        return view('admin.orders.list',[
            'orders' => $orders,
            'title' => 'Thông tin các đơn hàng'
        ]);
    }

    public function show(Order $order)
    {
        $orderHasFind = $this->orderServices->getOne($order);
        return view('admin.orders.edit',[
            'title' => 'Chỉnh Sửa Thông tin đơn hàng',
            'order' => $orderHasFind
        ]);
    }

    public function update(CreateFormRequest $request, Order $order)
    {
        $result = $this->orderServices->update($request, $order);
        if($result){
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->orderServices->delete($request->id);
        if($result){
            return redirect()->back();
        }
    }
}
