<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
