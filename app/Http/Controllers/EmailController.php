<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Builder\Param;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function except(Payment $payment, $token)
    {

        try {
            // Đặt token để sử dụng
            JWTAuth::setToken($token);

            // Kiểm tra token có hợp lệ hay không
            JWTAuth::parseToken()->authenticate();

            $payment->status = 1;
            $payment->save();

            return view('email.successpayment',[
                'address' => $payment->address,
                'phone' => $payment->phone,
            ]);
        } catch (TokenExpiredException $e) {
            // Token đã hết hạn
            // Logic xóa đơn hàng ở đây
            // ...
            if($payment->status) {
                if($payment->status == 0) {
                    Payment::where('id', $payment->id)->delete();
                } else {
                    return view('email.processpayment');
                }
            } else {
                return view('email.emptypayment');
            }
            return view('email.expirepayment');
        } catch (TokenInvalidException $e) {
            // Token không hợp lệ
            return view('email.errorpayment');
        } catch (JWTException $e) {
            // Lỗi khi xử lý token (token có thể bị thiếu)
            return response()->json([
                'message' => 'Token is required',
            ], 400);
        }
    }
}
