<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        //$channels = Channel::all();
      //  $channels = Channel::orderBy('name')->get();

//        return view('post.create',compact('channels'));
        return view('post.create');
    }
}
