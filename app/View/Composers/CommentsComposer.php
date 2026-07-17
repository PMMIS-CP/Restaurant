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

        $view->with('testimonials', $testimonials);
    }
}