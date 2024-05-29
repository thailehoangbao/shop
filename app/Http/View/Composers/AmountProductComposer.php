<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;

use App\Models\Order;
use Illuminate\View\View;

class AmountProductComposer
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

            // Retrieve the total amounts of products for the authenticated user
            $amounts = Order::where('user_id', $user_id)->pluck('amount');

            // Pass the amounts to the view
            $view->with('amounts', $amounts);
        }
    }
}
