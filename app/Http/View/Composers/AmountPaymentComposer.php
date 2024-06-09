<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;

use App\Models\Payment;
use Illuminate\View\View;

class AmountPaymentComposer
{
    public function __construct(public Payment $payments)
    {
    }

    public function compose(View $view)
    {
        $payments = Payment::all();
        $sum=0;
        foreach ($payments as $item) {
            $sum += 1;
        }
        $view->with('sum', $sum);
    }
}
