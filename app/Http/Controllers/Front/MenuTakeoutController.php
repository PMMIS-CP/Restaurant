<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuTakeoutController extends Controller
{
    public function index()
    {
        return view('front.pages.takeout', [
            'hideHeader' => true,
            'hideFooter' => true
        ]);
    }
}
