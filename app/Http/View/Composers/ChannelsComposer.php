<?php

namespace App\Http\View\Composers;


use App\Channel;
use Illuminate\View\View;
//Quite Different upload from the one imported in the app service provider boot that was a Facades

class ChannelsComposer
{
    public function compose(View $view){
        $view->with('channels', Channel::orderBy('name')->get());

    }
}
