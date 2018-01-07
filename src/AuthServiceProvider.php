<?php
namespace Verkoo\Common;

use Verkoo\Common\Entities\User;
use Verkoo\Common\Policies\UsersPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UsersPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     */
    public function boot()
    {
        $this->registerPolicies();
        RolePolicies::define();

        Passport::routes();
    }
}
