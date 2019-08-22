<?php

namespace App\Controllers;

use App\Exceptions\UnsupportedWebhookException;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Services\Shop\Cart;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Stripe\Charge;
use Stripe\Event;
use Stripe\PaymentIntent;

/**
 * Class OrdersController.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class OrdersController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return mixed
     * @throws UnsupportedWebhookException
     */
    public function webhook(Request $request): SuccessJsonResponse
    {
        $event = Event::constructFrom($request->all());

        switch ($event->type) {
            case 'payment_intent.succeeded':
                return $this->handlePaymentIntentSucceeded($event);
            default:
                throw new UnsupportedWebhookException($event->type);
        }
    }

    /**
     * Handle payment_intent.succeeded event
     *
     * @param Event $event
     *
     * @return SuccessJsonResponse
     */
    public function handlePaymentIntentSucceeded(Event $event)
    {
        /** @var PaymentIntent $paymentIntent */
        $paymentIntent = $event->data->object;
        /** @var Charge $charge */
        $charge = $paymentIntent->charges[0];

        /** @var User $user */
        $user = User::query()
            ->where("stripe_id", "=", $paymentIntent->customer)
            ->firstOrFail();
        /** @var Address $address */
        $address = Address::query()
            ->where("line1", "=", $paymentIntent->shipping->address->line1)
            ->firstOrFail();

        $cart = Cart::fromString($paymentIntent->metadata->cart);

        $order = new Order();
        $order->status = Order::PAID;
        $order->stripe_id = $paymentIntent->id;
        $order->address_id = $address->id;
        $order->user_id = $user->id;
        $order->receipt_url = $charge->receipt_url;
        $order->save();

        $attach = [];
        foreach ($cart->getItems() as $item) {
            $attach[$item["stock"]->id] = ["quantity" => $item["quantity"]];
        }
        $order->stocks()->attach($attach);

        return new SuccessJsonResponse($order);
    }
}
