<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPermissions;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::share(
            "topUsers",
            User::withCount('ideas')
                ->orderBy('ideas_count', 'desc')
                ->limit(5)->get()
        );



        $this->RegisterGate(); //i created this

        $this->RegisterPolicyManually(); //i created this
    }

    public function RegisterGate()
    {
        Gate::define('admin', function (User $user): bool {
            return (bool) $user->is_admin;
        });
    }

    public function RegisterPolicyManually()
    {
        //Gate::policy(Idea::class, IdeaPermissions::class);
    }
}
