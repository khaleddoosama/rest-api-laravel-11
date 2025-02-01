<?php

namespace App\Providers;


use App\Models\Tag;
use App\Models\User;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Events\UserLoggedIn;
use App\Listeners\RemoveOldTokens;
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
        Event::listen(
            UserLoggedIn::class,
            RemoveOldTokens::class,
        );
        
        Route::pattern('id', '[0-9]+');
        // Gate::policy(User::class, UserPolicy::class);
        // Gate::policy(Tag::class, TagPolicy::class);

    }
}