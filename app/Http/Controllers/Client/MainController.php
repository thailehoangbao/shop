<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('client.home',[
            'title' => 'Trang chủ Shop bán hàng',
        ]);
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'content' => 'required',
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'content.required' => 'Vui lòng nhập nội dung phản hồi',
        ]);

        $feedback = new Feedback();
        try {
            $feedback->email = $request->email;
            $feedback->content = $request->content;
            $feedback->save();
            return back()->with('success', 'Cảm ơn bạn đã phản hồi, chúng tôi sẽ phản hồi lại bạn sớm nhất có thể');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
