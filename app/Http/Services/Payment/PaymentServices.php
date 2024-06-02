<?php

namespace App\Http\Services\Payment;

use App\Models\Order;
use App\Models\Payment;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentServices
{
    public function getOrder($request)
    {
        // Get the authenticated user
        $user = auth()->user();
        // Check if user is authenticated
        if ($user) {
            // Get the user ID
            $user_id = $user->id;
            $lists = Order::where('user_id', $user_id)->with('product')->get();

            return $lists;
        } else {
            return [];
        }
    }

    public function create($request)
    {
        try {
            $customTTL = 120; // 2 hours
            JWTAuth::factory()->setTTL($customTTL);
            // Generate a JWT token
            $payload = [
                'user_id' => auth()->id(),
                'address' => $request->address,
                'phone' => $request->phone,
                'lists' => $request->lists,
                'timestamp' => now(),
            ];

            $token = JWTAuth::fromUser(auth()->user(), $payload);

            // Store payment details including the JWT token
            $payment = new Payment();
            $payment->address = $request->address;
            $payment->phone = $request->phone;
            $payment->token = $token;
            $payment->list = $request->lists;
            $payment->status = 0;
            $payment->save();
            return $payment;
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
