<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * نمایش نظرات تأیید شده برای عموم
     */
    public function index()
    {
        $testimonials = Comments::active()
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'name'    => $comment->name,
                    'comment' => $comment->comment,
                    'tags'    => $comment->tags ?? [],
                ];
            });

        return view('front.components.commetns', compact('testimonials'));
    }

    /**
     * ذخیره نظر ارسالی از کاربر لاگین‌شده
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        $comment = new Comments();
        $comment->name     = $validated['name'];
        $comment->comment  = $validated['comment'];
        $comment->tags     = [];
        $comment->is_active = false;
        $comment->user_id  = Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تأیید مدیر منتشر خواهد شد.');
    }
}