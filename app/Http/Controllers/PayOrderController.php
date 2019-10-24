<?php

namespace App\Http\Controllers;

use App\Billing\BankPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    //
    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGetway){
        //Create a reflection so everyone can know themselves add BankPaymentGateway $paymentGetway as a argument
        //$paymentGetway =  new BankPaymentGateway('usd');
        $order = $orderDetails->all();
        dd($paymentGetway->charge(2500));
    }
}
