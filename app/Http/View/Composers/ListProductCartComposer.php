<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;

use App\Models\Order;
use Illuminate\View\View;

class ListProductCartComposer
{
    public function __construct(public Order $orders)
    {
    }

    public function compose(View $view)
    {
        // Get the authenticated user
        $user = auth()->user();
        // Check if user is authenticated
        if ($user) {
            // Get the user ID
            $user_id = $user->id;
            $lists = Order::where('user_id', $user_id)->with('product')->get();
            // dd($lists->toArray());
            $view->with('lists', $lists);
        }
        $view->with('lists', []);
    }
}
