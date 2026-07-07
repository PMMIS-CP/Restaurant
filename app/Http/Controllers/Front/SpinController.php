<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Prize;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    public function index()
    {
        $prizes = Prize::all(); 
        return view('front.pages.spin', compact('prizes'));
    }

    public function spin(Request $request)
    {
        $prizes = Prize::all();
        $winner = $prizes->random();

        return response()->json([
            'status' => 'success', 
            'prize' => $winner->name,
            // چرخش نهایی را محاسبه می‌کنیم
            'rotation_degree' => $this->calculateRotationFor($winner, $prizes)
        ]);
    }

    private function calculateRotationFor($winner, $allPrizes)
    {
        $total = count($allPrizes);
        $sliceAngle = 360 / $total;
        
        // پیدا کردن ایندکس برنده
        $index = $allPrizes->search($winner);
        
        // زاویه شروع و پایان این بخش
        $startAngle = $index * $sliceAngle;
        
        // انتخاب یک زاویه تصادفی در دل همان بخش (برای اینکه همیشه روی یک نقطه خاص نایستد)
        $randomOffset = rand(5, $sliceAngle - 5);
        
        // محاسبه چرخش: 5 دور کامل (1800 درجه) + موقعیت جایزه
        return 1800 + $startAngle + $randomOffset;
    }
}
