<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
        $this->middleware('throttle:5,1')->only('store'); // اضافه کردن rate limit
    }

    public function index()
    {
        $starIcon = new HtmlString('<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>');

        $tagColors = [
            'سفارش آنلاین'           => 'bg-green-100 text-green-800',
            'رزرو میز'                => 'bg-blue-100 text-blue-800',
            'VIP'                     => 'bg-[#D4AF37]/20 text-[#8B0000] font-bold',
            'بازدید از کاخ سنتی موراکو' => 'bg-[#8B0000]/10 text-[#8B0000]',
        ];

        $testimonials = Comments::active()
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'name'    => e($comment->name),
                    'comment' => e($comment->comment),
                    'tags'    => array_map(function($tag) {
                        return e($tag); // Escape کردن تگ‌ها
                    }, $comment->tags ?? []),
                ];
            });

        return view('front.components.commetns', compact('testimonials', 'starIcon', 'tagColors'));
    }

    public function store(Request $request)
    {
        // Rate limiting بررسی - اضافه
        $dailyCount = Comments::where('user_id', Auth::id())
            ->where('created_at', '>=', now()->subHours(24))
            ->count();

        if ($dailyCount >= 10) {
            return redirect()->back()
                ->with('error', 'شما به حداکثر تعداد مجاز نظرات روزانه رسیده‌اید.');
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\p{Arabic}]+$/u',
            'comment' => 'required|string|max:1000',
        ], [
            'name.regex' => 'نام فقط می‌تواند شامل حروف و اعداد باشد.',
        ]);

        $cleanComment = trim(strip_tags($validated['comment']));
        
        // بررسی خالی نبودن نظر بعد از پاکسازی
        if (empty($cleanComment)) {
            return redirect()->back()
                ->with('error', 'متن نظر نمی‌تواند خالی باشد.')
                ->withInput();
        }
        
        $duplicate = Comments::where('user_id', Auth::id())
            ->where('comment', $cleanComment)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if ($duplicate) {
            return redirect()->back()
                ->with('error', 'نظر تکراری شناسایی شد. لطفاً چند دقیقه صبر کنید.')
                ->withInput();
        }

        $comment = new Comments();
        $comment->name      = trim(strip_tags($validated['name']));
        $comment->comment   = $cleanComment;
        $comment->tags      = [];
        $comment->is_active = false;
        $comment->user_id   = Auth::id();
        $comment->save();

        return redirect()->back()
            ->with('success', 'نظر شما با موفقیت ثبت شد و پس از تأیید مدیر منتشر خواهد شد.');
    }
}