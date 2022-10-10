<?php

    namespace Multimedia\Multistore\Providers;

    use Illuminate\Support\ServiceProvider;
    use \App\Modules\Stock\Providers;

    class MultiStoreServiceProvider extends ServiceProvider {

        public function register()
        {
            $this->app->register(ConsoleServiceProvider::class);

            $provider = "\\App\\Modules\\Stock\\Providers\\StockServiceProvider";
            $this->app->register($provider);
        }
    }
