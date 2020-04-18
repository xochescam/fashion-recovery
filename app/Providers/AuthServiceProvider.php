<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Module;
use App\Item;
use App\Closet;
use App\User;

use App\Policies\ItemPolicy;
use App\Policies\ClosetPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Item::class => ItemPolicy::class,
        Closet::class => ClosetPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Grant all access to superadmins
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        // Dynamically register permissions with Laravel's Gate.
        foreach ($this->getModules() as $module) {
            Gate::define($module->ModuleName, function ($user) use ($module) {
                return $user->hasPermission($module);
            });
        }
    }

     /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getModules()
    {
        return Module::all();
    }
}