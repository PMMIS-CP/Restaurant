<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    private function getPrizes()
    {
        return collect([
            ['name' => 'پیتزا مخصوص', 'color' => '#ef4444'],
            ['name' => 'نوشابه رایگان', 'color' => '#3b82f6'],
            ['name' => 'تخفیف ۵۰٪', 'color' => '#f59e0b'],
            ['name' => 'سالاد فصل', 'color' => '#10b981'],
            ['name' => 'سیب‌زمینی', 'color' => '#8b5cf6'],
            ['name' => 'شانس مجدد', 'color' => '#ec4899'],
        ]);
    }

    private function calculateWheelData($prizes)
    {
        $total = count($prizes);
        $sliceAngle = 360 / $total;
        $wheelData = [];

        foreach ($prizes as $index => $prize) {
            $startAngle = $index * $sliceAngle;
            $endAngle = ($index + 1) * $sliceAngle;
            $midAngle = $startAngle + ($sliceAngle / 2);

            $startSvg = $startAngle - 90;
            $endSvg = $endAngle - 90;
            $midSvg = $midAngle - 90;

            $x1 = 50 + 50 * cos(deg2rad($startSvg));
            $y1 = 50 + 50 * sin(deg2rad($startSvg));
            $x2 = 50 + 50 * cos(deg2rad($endSvg));
            $y2 = 50 + 50 * sin(deg2rad($endSvg));

            $textRadius = 35;
            $textX = 50 + $textRadius * cos(deg2rad($midSvg));
            $textY = 50 + $textRadius * sin(deg2rad($midSvg));

            $textRotation = $midAngle;

            $lightRadius = 44; // شعاع نزدیک به لبه برای حلقه‌های نوری
            $lightX = 50 + $lightRadius * cos(deg2rad($midSvg));
            $lightY = 50 + $lightRadius * sin(deg2rad($midSvg));

            $wheelData[] = [
                'prize' => $prize,
                'startAngle' => $startAngle,
                'endAngle' => $endAngle,
                'midAngle' => $midAngle,
                'x1' => $x1,
                'y1' => $y1,
                'x2' => $x2,
                'y2' => $y2,
                'textX' => $textX,
                'textY' => $textY,
                'textRotation' => $textRotation,
                'lightX' => $lightX,  // اضافه شود
                'lightY' => $lightY,  // اضافه شود
            ];
        }

        return [
            'wheelData' => $wheelData,
            'total' => $total,
            'sliceAngle' => $sliceAngle
        ];
    }

    public function index()
    {
        $prizes = $this->getPrizes();
        $wheelCalculation = $this->calculateWheelData($prizes->toArray());
        
        return view('front.pages.spin', array_merge(
            compact('prizes'),
            [
                'hideHeader' => true,
                'hideFooter' => true,
                'total' => $wheelCalculation['total'],
                'sliceAngle' => $wheelCalculation['sliceAngle'],
                'wheelData' => $wheelCalculation['wheelData'],
            ]
        ));
    }
}