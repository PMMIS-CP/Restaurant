<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('front.pages.menu', [
            'hideHeader' => true,
            'hideFooter' => true
        ]);
        
    }

    public function takeout()
    {
        return view('front.pages.takeout', [
            'hideHeader' => true,
            'hideFooter' => true
        ]);
    }
}