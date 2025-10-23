<?php

namespace App\View\Components\Link;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkSidebar extends Component
{
    /**
     * Create a new component instance.
     */

    public string $title, $route, $icon;

    public function __construct($title, $route, $icon)
    {
        $this->title = $title;
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link.link-sidebar');
    }
}
