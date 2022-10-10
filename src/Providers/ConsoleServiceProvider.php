<?php

    namespace MultiMedia\MultiStore\Providers;

    use Illuminate\Support\ServiceProvider;
    use MultiMedia\MultiStore\Commands;

    class ConsoleServiceProvider extends ServiceProvider {
        protected $commands = [
            Commands\ModulesCreateCommand::class,
            Commands\ModulesCommandCommand::class
        ];

        public function boot() {
            $this->commands($this->commands);
        }
    }

?>
