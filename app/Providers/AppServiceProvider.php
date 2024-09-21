<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPermissions;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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

        Debugbar::enable();

        //we should not cache contents changing frequently
        //php artisan cache:clear = Cache::flush()
        //rememberForever does not need ttl
        //Cache::forget('topUsers')
        $topUsers = Cache::remember('topUsers', Carbon::now()->addMinutes(5)->addSeconds(3), function () {
            return User::withCount('ideas')
                ->orderBy('ideas_count', 'desc')
                ->limit(5)->get();
        });

        View::share(
            "topUsers",
            $topUsers
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
