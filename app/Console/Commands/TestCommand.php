<?php


namespace App\Console\Commands;


use App\Models\Product;
use App\Models\User;
use Mathrix\Lumen\Zero\Console\Commands\BaseCommand;
use Stripe\PaymentIntent;

class TestCommand extends BaseCommand
{
    protected $signature = "test";

    public function handle()
    {
        $user = User::query()->findOrFail(2);
        dd($user->orders()->with(["stocks.product"])->get()->toArray());
    }
}
