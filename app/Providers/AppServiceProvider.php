<?php

namespace App\Providers;

use App\Http\ViewComposers\MenuComposer;
use App\Observers\PermissionObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production') || config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('panels.sidebar', MenuComposer::class);

        Permission::observe(PermissionObserver::class);
        Role::observe(PermissionObserver::class);
    }
}
