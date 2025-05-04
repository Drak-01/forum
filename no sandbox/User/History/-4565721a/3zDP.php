<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Group;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('partials.right-sidebar', function ($view) {
            $view->with([
                'groups' => Group::withCount('users')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
                // Ajoutez ici d'autres données partagées si nécessaire
            ]);
        });
    }
}
