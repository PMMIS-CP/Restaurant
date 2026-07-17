<?php

namespace App\View\Composers;

use App\Models\Comments;
use Illuminate\View\View;

class CommentsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $starIcon = '<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';

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
                    'name'    => $comment->name,
                    'comment' => $comment->comment,
                    'tags'    => $comment->tags ?? [],
                ];
            });

        $view->with(compact('testimonials', 'starIcon', 'tagColors'));
    }
}