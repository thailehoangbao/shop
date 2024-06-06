<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;


class MainController extends Controller
{
    public function index()
    {
        return view('client.home',[
            'title' => 'Trang chủ Shop bán hàng',
        ]);
    }
}
