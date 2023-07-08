<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostItem extends Component
{
    /**
     * Create a new component instance.
     */

    public bool $showAuthor;
    public function __construct(public Post $post, $showAuthor = true)
    {
        $this->showAuthor = $showAuthor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-item');
    }
}
