<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\MenuService;
use Illuminate\Console\Command;

class MenuCacheRefresh extends Command
{
    protected $signature = 'menu:cache-refresh';

    protected $description = 'Warm the per-user menu cache for all users';

    public function __construct(private readonly MenuService $menuService)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $count = 0;

        User::query()->each(function (User $user) use (&$count) {
            $this->menuService->clearMenuCache($user->id);
            $this->menuService->getMenuForUser($user);
            $count++;
        });

        $this->info("Menu cached for {$count} users.");

        return self::SUCCESS;
    }
}
