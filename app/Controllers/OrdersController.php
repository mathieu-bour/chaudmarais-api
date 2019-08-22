<?php

namespace App\Controllers;

use App\Exceptions\UnsupportedWebhookException;
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
        $charge = $paymentIntent->charges->data[0];

        /** @var User $user */
        $user = User::query()
            ->where("stripe_id", "=", $paymentIntent->customer)
            ->firstOrFail();

        $content = Cart::fromString($paymentIntent->metadata->cart)
            ->getItems()
            ->toArray();

        $order = new Order();
        $order->status = Order::PAID;
        $order->content = $content;
        $order->shipping = array_merge(
            ["name" => $paymentIntent->shipping->name],
            json_decode(json_encode($paymentIntent->shipping->address), true)
        );
        $order->receipt_url = $charge->receipt_url;
        $order->stripe_id = $paymentIntent->id;
        $order->user_id = $user->id;
        $order->save();

        return new SuccessJsonResponse($order);
    }
}
