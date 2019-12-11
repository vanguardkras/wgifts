<?php

namespace App\Providers;

use App\User;
use \Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\GiftList' => 'App\Policies\GiftListPolicy',
        'App\Gift' => 'App\Policies\GiftPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
