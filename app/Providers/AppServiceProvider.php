<?php

namespace App\Providers;

use App\Console\Kernel;
use App\Exceptions\Handler;
use Barryvdh\Cors\HandleCors;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Illuminate\Contracts\Console\Kernel as LaravelKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use Mathrix\Lumen\JWT\Auth\JWTServiceProvider;
use Mathrix\Lumen\Zero\Providers\ObserverServiceProvider;
use Mathrix\Lumen\Zero\Providers\PolicyServiceProvider;
use Mathrix\Lumen\Zero\Providers\RegistrarServiceProvider;
use Stripe\Stripe;

/**
 * Class AppServiceProvider.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property Application $app
 */
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

        $this->app->middleware([
            HandleCors::class
        ]);

        $this->app->register(CorsServiceProvider::class);
        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(RegistrarServiceProvider::class);
        $this->app->register(JWTServiceProvider::class);

        Stripe::setApiKey(env("STRIPE_SK_KEY"));
    }
}
