<?php

namespace App\Http\Services;

use App\Models\Payment;

class MainServices
{
    public function getListsPayments($id)
    {
        return Payment::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
