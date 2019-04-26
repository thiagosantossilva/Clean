<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
		// Auth gates for: User management
        Gate::define('admin_home', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
		
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Clean management
        Gate::define('clean_management_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        // Auth gates for: Configurations
        Gate::define('configuration_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Cleaning status
        Gate::define('cleaning_status_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_status_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_status_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_status_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_status_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Clients management
        Gate::define('clients_management_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Clients
        Gate::define('client_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('client_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('client_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('client_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('client_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Cleans
        Gate::define('clean_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('clean_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('clean_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('clean_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('clean_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
		Gate::define('clean_calendar_access', function ($user) {
            return in_array($user->role_id, [3]);
        });

        // Auth gates for: Cleaning type
        Gate::define('cleaning_type_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_type_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_type_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_type_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleaning_type_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Address type
        Gate::define('address_type_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('address_type_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('address_type_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('address_type_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('address_type_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Clean category
        Gate::define('clean_category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('clean_category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('clean_category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('clean_category_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('clean_category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Minhas faxinas
        Gate::define('minhas_faxina_access', function ($user) {
            return in_array($user->role_id, [3]);
        });

        // Auth gates for: Faxinas abertas
        Gate::define('faxinas_aberta_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        // Auth gates for: Cleans feedbacks
        Gate::define('cleans_feedback_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('cleans_feedback_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('cleans_feedback_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('cleans_feedback_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('cleans_feedback_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
