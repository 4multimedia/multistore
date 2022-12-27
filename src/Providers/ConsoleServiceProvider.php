<?php

    namespace Multimedia\Multistore\Providers;

    use Illuminate\Support\ServiceProvider;
    use Multimedia\Multistore\Commands;

    class ConsoleServiceProvider extends ServiceProvider {
        protected $commands = [
            Commands\ModulesCreateCommand::class,
            Commands\ModulesCommandCommand::class,
			Commands\ModulesCreateUser::class,
			Commands\ModulesCreateUserRole::class,
            Commands\ModulesControllerCreate::class,
            Commands\ModulesClassCreate::class,
            Commands\ModulesCreateMigration::class,
        ];

        public function boot() {
            $this->commands($this->commands);
        }
    }

?>
