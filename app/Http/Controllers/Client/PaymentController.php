<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreateFormRequest;
use App\Http\Services\Payment\PaymentServices;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentServices;

    public function __construct(PaymentServices $paymentServices) {
        $this->paymentServices = $paymentServices;
    }

    public function index(Request $request)
    {
        // Decode the JSON encoded lists data
        $lists = json_decode($request->lists, true);
        // Convert each item in the list to an object
        $convertedLists = collect($lists)->map(function ($item) {
            $item['product'] = (object) $item['product'];
            return (object) $item;
        });

        return view('client.payment.payment',[
            'lists' => $convertedLists
        ]);
    }

    public function store(Request $request)
    {
        $result = $this->paymentServices->create($request);
        if ($result) {
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
