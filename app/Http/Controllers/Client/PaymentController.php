<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
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
        
        $data = $request->all();
        $data['list'] = json_encode($data['list']);
        $data['status'] = 0;
        $data['token'] = md5(time());
        Order::create($data);
        return redirect()->route('client.home');
    }
}
