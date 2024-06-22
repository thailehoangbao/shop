<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreateFormRequest;
use App\Http\Services\Payment\PaymentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $paymentServices;

    public function __construct(PaymentServices $paymentServices)
    {
        $this->paymentServices = $paymentServices;
    }

    public function index(Request $request)
    {
        $lists = $this->paymentServices->getOrder($request);
        return view('client.payment.payment', [
            'lists' => $lists
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->paymentServices->create($request);
        if ($result) {
            $token = $result->token;
            $id = $result->id;
            $to_email = auth()->user()->email;

            Mail::send('email.formemail', ['token' => $token,'id'=> $id], function ($message) use ($token,$id, $to_email) {
                $message->to($to_email, $token, $id)
                    ->subject('Your Order Shopping');
                $message->from('diamondriverside.vip@gmail.com', 'MiuMiu Store');
            });

            Mail::send('email.notificatepayment', ['email' => $to_email,'id'=> $id ], function ($message) use ($to_email, $id) {
                $message->to('diamondriverside.vip@gmail.com', $to_email, $id)
                    ->subject('You have new payment!!!');
                $message->from('diamondriverside.vip@gmail.com', 'MiuMiu Store');
            });

            return redirect()->route('home')->with('success', 'Vui lòng kiểm tra email của bạn!');
        }
        return redirect()->back()->with('error', 'Đã có lỗi xảy ra!');
    }
}
