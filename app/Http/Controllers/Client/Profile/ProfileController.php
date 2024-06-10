<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateFormRequest;
use App\Http\Services\Profile\ProfileServices;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(ProfileServices $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function index()
    {
        $result = $this->profileRepository->getListsPayments(Auth::user()->id);
        if ($result) {
            return view('client.profile.profile', [
                'payments' => $result
            ]);
        }
        return redirect()->back()->with('error', 'Lấy thông tin thất bại');
    }

    public function update(CreateFormRequest $request)
    {
        $result = $this->profileRepository->update($request);
        if ($result) {
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
    }

    public function destroy(HttpRequest $request)
    {
        $result = $this->profileRepository->destroy($request->id);
        if ($result) {
            return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
        }
        return redirect()->back()->with('error', 'Xóa đơn hàng thất bại hoặc đơn hàng đang trong quá trình xử lý');
    }

    public function showDetail(HttpRequest $request)
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
        return view('client.payment.detail', [
            'title' => 'Payment Detail',
            'orders' => $orders
        ]);
    }
}
