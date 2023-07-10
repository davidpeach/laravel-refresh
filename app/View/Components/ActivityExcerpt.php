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
        return view('components.activity-excerpt');
    }
}
