<?php

namespace App\View\Components;

use App\Models\Activity;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityExcerpt extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Activity $activity)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return match ($this->activity->type) {
            'article' => view('partials.article-excerpt'),
            'note' => view('partials.note-excerpt'),
            'photo' => view('partials.photo-excerpt'),
            default => view('components.activity-excerpt'),
        };
    }
}
