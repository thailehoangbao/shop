<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaymentServices;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentServices $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        $payments = $this->paymentService->getAll();
        return view('admin.payment.list', [
            'title' => 'Payment List',
            'payments' => $payments
        ]);
    }


    public function detail(Request $request)
    {
        // Giả mã chuỗi JSON
        $orders = json_decode($request->list, true);

        // Lấy danh sách các product_id từ mảng $orders
        $productIds = array_column($orders, 'product_id');

        // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu dựa trên product_ids
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Gắn thông tin sản phẩm vào mảng $orders
        foreach ($orders as $order) {
            $productId = $order['product_id'];
            if (isset($products[$productId])) {
                $order['product_info'] = $products[$productId];
            } else {
                $order['product_info'] = null; // Hoặc xử lý theo cách bạn muốn nếu không tìm thấy sản phẩm
            }
        }

        // Sau khi hoàn thành, bạn có thể sử dụng mảng $orders với thông tin sản phẩm đã được gắn vào
        return view('admin.payment.detail', [
            'title' => 'Payment Detail',
            'orders' => $orders
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->paymentService->delete($request->id);
        if($result)
        {
            return redirect()->route('payment.list');
        }
        return redirect()->back()->with('error', 'Payment deleted failed!');
    }

    public function show($id)
    {
        $payment = $this->paymentService->findById($id);
        return view('admin.payment.edit', [
            'title' => 'Payment Update status',
            'payment' => $payment
        ]);
    }

    public function update(Request $request, $id)
    {
        $result = $this->paymentService->update($request, $id);
        if($result)
        {
            return redirect()->back()->with('success', 'Payment updated successfully!');
        }
        return redirect()->back()->with('error', 'Payment updated failed!');
    }
}
