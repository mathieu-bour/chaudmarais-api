<?php

namespace Tests\Webhooks;

use App\Models\Address;
use App\Models\User;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;
use Tests\TestCase;

class PaymentIntentWebhookTest extends TestCase
{
    use DebugTrait;

    public function testPaymentIntentSuccess()
    {
        /** @var Address $address */
        $address = Address::random();
        /** @var User $user */
        $user = $address->user;

        $json = json_decode(file_get_contents(__DIR__ . "/Payloads/payment_intent.success.json"));

        $json->data->object->customer = $user->stripe_id;
        $json->data->object->shipping->address->line1 = $address->line1;

        $this->json("post", "/orders/webhook", (array)$json);

        $this->debug();
    }
}
