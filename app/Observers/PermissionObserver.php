<?php

namespace App\Observers;

use App\Services\MenuService;
use Illuminate\Database\Eloquent\Model;

class PermissionObserver
{
    public function __construct(private readonly MenuService $menuService)
    {
    }

    public function saved(Model $model): void
    {
        $this->menuService->clearAllMenuCache();
    }

    public function deleted(Model $model): void
    {
        $this->menuService->clearAllMenuCache();
    }
}
