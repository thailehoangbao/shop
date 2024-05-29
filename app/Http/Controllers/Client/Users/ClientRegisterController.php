<?php

namespace App\Http\Controllers\Client\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientRegisterController extends Controller
{
    public function index() {
        return view('client.users.register');
    }
}
