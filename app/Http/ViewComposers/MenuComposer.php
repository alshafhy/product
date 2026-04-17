<?php

namespace App\Http\ViewComposers;

use App\Services\MenuService;
use Illuminate\View\View;

class MenuComposer
{
    public function __construct(private readonly MenuService $menuService)
    {
    }

    public function compose(View $view): void
    {
        $view->with('menuItems', $this->menuService->getMenuForUser(auth()->user()));
    }
}
