<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $to_name = 'Nguyễn Văn A';
        $to_email = 'thaibao29111994@gmail.com';

        Mail::send('email.layout', ['name' => $to_name], function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Notification Shopping');
            $message->from('diamondriverside.vip@gmail.com', 'Shopping');
        });

        return "Email sent successfully!";
    }
}
