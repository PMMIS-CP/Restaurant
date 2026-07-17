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

        $tagColors = [
            'سفارش آنلاین'           => 'bg-green-100 text-green-800',
            'رزرو میز'                => 'bg-blue-100 text-blue-800',
            'VIP'                     => 'bg-[#D4AF37]/20 text-[#8B0000] font-bold',
            'بازدید از کاخ سنتی موراکو' => 'bg-[#8B0000]/10 text-[#8B0000]',
        ];

        $predefinedKeys = array_keys($tagColors);
        $currentTags = $comment->tags ?? [];
        $customTags = array_diff($currentTags, $predefinedKeys);
        $customTagsString = implode('، ', $customTags);

        return view('admin.comments.edit', compact('comment', 'tagColors', 'customTagsString'));
    }

    /**
     * به‌روزرسانی نظر (فیلد user_id تغییر نمی‌کند)
     */
    public function update(Request $request, Comments $comment)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'comment'     => 'required|string',
            'tags'        => 'nullable|array',
            'tags.*'      => 'string|max:255',
            'custom_tags' => 'nullable|string|max:500',
            'is_active'   => 'boolean',
        ]);

        $predefined = $request->input('tags', []);
        $customRaw  = $request->input('custom_tags', '');

        $custom = [];
        if (!empty($customRaw)) {
            $custom = array_map('trim', explode('،', $customRaw));
            $custom = array_filter($custom, fn($tag) => !empty($tag));
        }

        $allTags = array_values(array_unique(array_merge($predefined, $custom)));

        $comment->update([
            'name'      => $validated['name'],
            'comment'   => $validated['comment'],
            'tags'      => $allTags,
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