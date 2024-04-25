<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('create-post', function(User $user) {
            return $user->is_admin;
        });

        Gate::define('user-post', function(User $user){
            return $user->is_admin;
        });

        Gate::define('update-post', function(User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-post', function(User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Paginator::useBootstrap();
    }
}
