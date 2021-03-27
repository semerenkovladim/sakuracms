<?php

namespace App\Providers;

use App\Policies\CategoryPolicy;
use App\Policies\CurrencyPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\NewsletterPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PromotionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-category', [CategoryPolicy::class, 'create']);
        Gate::define('update-category', [CategoryPolicy::class, 'update']);
        Gate::define('delete-category', [CategoryPolicy::class, 'delete']);

        Gate::define('create-product', [ProductPolicy::class, 'create']);
        Gate::define('update-product', [ProductPolicy::class, 'update']);
        Gate::define('delete-product', [ProductPolicy::class, 'delete']);

        Gate::define('create-currency', [CurrencyPolicy::class, 'create']);
        Gate::define('update-currency', [CurrencyPolicy::class, 'update']);
        Gate::define('delete-currency', [CurrencyPolicy::class, 'delete']);

        Gate::define('create-language', [LanguagePolicy::class, 'create']);
        Gate::define('update-language', [LanguagePolicy::class, 'update']);
        Gate::define('delete-language', [LanguagePolicy::class, 'delete']);

        Gate::define('create-newsletter', [NewsletterPolicy::class, 'create']);
        Gate::define('delete-newsletter', [NewsletterPolicy::class, 'delete']);

        Gate::define('update-order', [OrderPolicy::class, 'update']);
        Gate::define('delete-order', [OrderPolicy::class, 'delete']);

        Gate::define('create-promotion', [PromotionPolicy::class, 'create']);
        Gate::define('delete-promotion', [PromotionPolicy::class, 'delete']);

        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(2));
        //
    }
}
