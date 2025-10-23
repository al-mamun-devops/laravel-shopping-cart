<?php


namespace AlMamunDevOps\ShoppingCart;


use Illuminate\Support\ServiceProvider;
use AlMamunDevOps\ShoppingCart\Services\CartManager;


class ShoppingCartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shoppingcart.php', 'shoppingcart');


        $this->app->singleton('cart', function ($app) {
            return new CartManager($app['config']->get('shoppingcart'));
        });


        // Bind interface if someone prefers DI
        $this->app->bind(\AlMamunDevOps\ShoppingCart\Contracts\CartInterface::class, function ($app) {
            return $app->make('cart');
        });
    }


    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__ . '/../config/shoppingcart.php' => config_path('shoppingcart.php'),
        ], 'config');


        // load views (optional)
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'shoppingcart');
    }
}