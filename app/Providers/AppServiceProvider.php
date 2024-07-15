<?php

namespace App\Providers;

use Lunar\Base\ShippingModifiers;
use Lunar\Shipping\ShippingPlugin;
use App\Modifiers\ShippingModifier;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Support\Facades\LunarPanel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        LunarPanel::panel(
            fn ($panel) => $panel->plugins([
                new ShippingPlugin,
            ])
        )
            ->register();

        if (env(key: 'APP_ENV') !=='local') {
                URL::forceScheme(scheme:'https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
        $shippingModifiers->add(
            ShippingModifier::class
        );
    }
}
