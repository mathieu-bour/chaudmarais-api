<?php

namespace App\Controllers;

use App\Services\Shop\Cart;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Stripe\PaymentIntent;

class CartController extends BaseController
{
    /**
     * POST /cart/check
     * Allow to check the cart, given a array of [stock_id, quantity].
     *
     * @param Request $request
     *
     * @return SuccessJsonResponse
     */
    public function check(Request $request): SuccessJsonResponse
    {
        $cart = new Cart($request->json("cart"));

        return new SuccessJsonResponse([
            "cart" => $cart->jsonSerialize(),
            "subtotal" => $cart->getSubtotal(),
            "total" => $cart->getTotal()
        ]);
    }

    public function initialize(Request $request): SuccessJsonResponse
    {
        $user = $request->user();
        $rawCart = $request->json("cart");
        $cart = new Cart($rawCart);

        $paymentIntent = PaymentIntent::create([
            "amount" => $cart->getTotal(),
            "currency" => "eur",
            "metadata" => [
                "cart" => json_encode($cart)
            ]
        ]);

        return new SuccessJsonResponse($paymentIntent);
    }

    public function update(Request $request, string $paymentIntentId)
    {
        $paymentIntent = PaymentIntent::update($paymentIntentId, $request->all());
        return new SuccessJsonResponse($paymentIntent);
    }
}
