<?php

namespace App\Providers;

use App\Console\Kernel;
use App\Exceptions\Handler;
use Illuminate\Contracts\Console\Kernel as LaravelKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Mathrix\Lumen\JWT\Auth\JWTServiceProvider;
use Mathrix\Lumen\Zero\Providers\ObserverServiceProvider;
use Mathrix\Lumen\Zero\Providers\PolicyServiceProvider;
use Mathrix\Lumen\Zero\Providers\RegistrarServiceProvider;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ExceptionHandler::class,
            Handler::class
        );

        $this->app->singleton(
            LaravelKernel::class,
            Kernel::class
        );

        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(RegistrarServiceProvider::class);

        $this->app->register(JWTServiceProvider::class);

        Stripe::setApiKey(env("STRIPE_SK_KEY"));
    }
}
