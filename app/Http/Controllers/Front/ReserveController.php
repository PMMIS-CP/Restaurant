<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // اضافه کنید

class ReserveController extends Controller
{
    public function index()
    {
        return view('front.pages.reserve', [
            'hideHeader' => true,
            'hideFooter' => false
        ]);
    }

    public function store(Request $request)
    {
        // لاگ کردن داده‌های دریافتی
        Log::info('Reserve store called', $request->all());
        
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'event_type'       => 'nullable|string|max:255',
            'guest_count'      => 'nullable|string|max:50',
            'reservation_date' => 'required|string|max:20',
            'entry_time'       => 'required|string|max:5',
            'exit_time'        => 'required|string|max:5',
            'description'      => 'nullable|string|max:2000',
        ]);

        Log::info('Validated data:', $validated);

        $reserve = Reserve::create($validated + ['status' => 'pending']);
        
        Log::info('Reserve created:', ['id' => $reserve->id]);

        return response()->json([
            'success' => true,
            'message' => 'درخواست رزرو با موفقیت ثبت شد.'
        ]);
    }
}