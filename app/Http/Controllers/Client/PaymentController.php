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
        // // Decode the JSON encoded lists data
        // $lists = json_decode($request->lists, true);
        // // Convert each item in the list to an object
        // $convertedLists = collect($lists)->map(function ($item) {
        //     $item['product'] = (object) $item['product'];
        //     return (object) $item;
        // });
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
                $message->from('diamondriverside.vip@gmail.com', 'Shopping');
            });
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
