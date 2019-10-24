<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Only  one instance in whole request call singleton
       /* $this->app->bind(BankPaymentGateway::class,function ($app){
            return new BankPaymentGateway('usd');
        });*/

        $this->app->singleton(PaymentGatewayContract::class,function ($app) {
            //http://localhost:8000/pay?credit=true //Try this
            if(request()->has('credit')){
            return new CreditPaymentGateway('usd');
            }
            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
