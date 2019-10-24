<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use Illuminate\Support\Facades\View;
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
        //Only do when it is absolutely necessary. Only when every single view need the information
        //View::share('channels',Channel::orderBy('name')->get());

        //option -2 Granular Views with wildcards
        // can go 'post.*' -every single view inside post will get the data, variable
//        View::composer(['post.create', 'channel.index'],function($view){
//            $view->with('channels',Channel::orderBy('name')->get());
//
//        });

        //Option -3 Dedicated
//        View::composer(['post.create', 'channel.index'], ChannelsComposer::class);
        //Refactoring option 3
        View::composer(['partials.channels.*'], ChannelsComposer::class);
    }
}
