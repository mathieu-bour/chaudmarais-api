<?php

namespace App\Controllers;

use App\Services\Shop\Cart;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Stripe\PaymentIntent;

class OrdersController extends BaseController
{
    public function standardPost(Request $request): SuccessJsonResponse
    {
        $cart = new Cart($request->json("cart"));

        $paymentIntent = PaymentIntent::create([
            "amount" => $cart->getTotal(),
            "currency" => "eur"
        ]);
    }
}
