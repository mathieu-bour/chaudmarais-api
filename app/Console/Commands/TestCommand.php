<?php


namespace App\Console\Commands;


use App\Models\Product;
use Mathrix\Lumen\Zero\Console\Commands\BaseCommand;
use Stripe\PaymentIntent;

class TestCommand extends BaseCommand
{
    protected $signature = "test";

    public function handle()
    {
        $p = PaymentIntent::retrieve("pi_1FANVRElZAjOaET6pTYE0DQ1");
        dd($p->charges->data[0]->receipt_url);
    }
}
