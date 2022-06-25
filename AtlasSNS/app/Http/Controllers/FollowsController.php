<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }


    // public function following()
    // {
    //     $this->follows = new Follow();

    //     $results = $this->follows->getFollowCount();

    //     return view('layouts.login', compact('results',));

    // }


}
