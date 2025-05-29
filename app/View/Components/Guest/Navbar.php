<?php

namespace App\View\Components\Guest;

use App\Models\CategoryArticle;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $navCategories;

    public function __construct()
    {
        $this->navCategories = CategoryArticle::orderBy('name')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.guest.navbar');
    }
}
