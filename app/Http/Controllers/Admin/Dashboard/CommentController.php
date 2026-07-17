<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * نمایش لیست تمام نظرات با اطلاعات کاربر
     */
    public function index()
    {
        $comments = Comments::with('user')
            ->latest()
            ->paginate(15);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * نمایش جزئیات یک نظر (با کاربر)
     */
    public function show(Comments $comment)
    {
        $comment->load('user');
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * فرم ویرایش نظر
     */
    public function edit(Comments $comment)
    {
        $comment->load('user');
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * به‌روزرسانی نظر (فیلد user_id تغییر نمی‌کند)
     */
    public function update(Request $request, Comments $comment)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'comment'    => 'required|string',
            'tags_input' => 'nullable|string|max:500',     // تغییر کرد: دریافت رشته
            'is_active'  => 'boolean',
        ]);

        // تبدیل رشته تگ‌ها به آرایه
        $tags = [];
        if (!empty($validated['tags_input'])) {
            $tags = array_map('trim', explode('،', $validated['tags_input']));
            // حذف آیتم‌های خالی
            $tags = array_filter($tags, fn($tag) => !empty($tag));
        }

        // جایگزینی tags_input با آرایه tags برای ذخیره در دیتابیس
        $comment->update([
            'name'      => $validated['name'],
            'comment'   => $validated['comment'],
            'tags'      => array_values($tags),   // ریست کلیدهای آرایه
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر با موفقیت ویرایش شد.');
    }

    /**
     * حذف نظر
     */
    public function destroy(Comments $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر حذف شد.');
    }

    /**
     * تغییر سریع وضعیت فعال/غیرفعال
     */
    public function toggleStatus(Comments $comment)
    {
        $comment->is_active = !$comment->is_active;
        $comment->save();
        return back()->with('success', 'وضعیت نظر تغییر کرد.');
    }
}