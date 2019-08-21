<?php


namespace App\Controllers;


use App\Exceptions\UnsupportedWebhookException;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Stripe\Event;
use Stripe\PaymentIntent;

class OrdersController
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
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                return $this->handlePaymentIntentSucceeded($event);
            default:
                throw new UnsupportedWebhookException($event->type);
        }
    }

    public function handlePaymentIntentSucceeded(Event $event)
    {
        /** @var PaymentIntent $paymentIntent */
        $paymentIntent = $event->data->object;

        /** @var User $user */
        $user = User::query()
            ->where("stripe_id", "=", $paymentIntent->customer)
            ->firstOrFail();

        $address = Address::query()
            ->where("line1", "=", $paymentIntent->shipping->address->line1)
            ->firstOrFail();

        $metadata = json_decode($paymentIntent->metadata, true);
        $order = new Order();
        $order->stripe_id = $paymentIntent->id;
        $order->user_id = $user->id;
        $order->save();

        foreach ($metadata as $stockId => $quantity) {
            $metadata[$stockId] = ["quantity" => $quantity];
        }

        $order->stocks()->attach($metadata);

        return new SuccessJsonResponse($order);
    }
}
