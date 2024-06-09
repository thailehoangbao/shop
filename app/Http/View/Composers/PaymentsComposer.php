<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;

use App\Models\Payment;
use Illuminate\View\View;

class PaymentsComposer
{
    public function compose(View $view)
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        $view->with('payments', $payments);
    }
}
