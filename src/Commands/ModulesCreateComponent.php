<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Multimedia\Multistore\Support\File;
use Multimedia\Multistore\Support\Stub;

class ModulesCreateComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:component.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new class in exists module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$array = [];
		$modules = get_modules();
        $module = $this->choice('Select module', get_modules());

		$array["module"] = $modules[array_search($module, $modules)];
        $isDir = is_dir(app_path('Modules/'.$array["module"]));
        if (!$isDir) {
            $this->error('Wrong module name');
        } else {
            $array["component"] = $this->ask('Enter component name');

            $array["extended"] = $this->confirm('Added to extended module?', false);

            $array['place'] = $this->choice('Place', [0 => 'Frontend', 1 => 'Backend']);

			@mkdir(app_path('Modules/'.$array["module"].'/Resources/views/'.strtolower($array["place"]).'/components'));

            $array['namespace'] = "App\Modules\\".$array["module"]."\View\Components";
			$array['fileLocation'] = "View/Components/".$array['component'].ucfirst(strtolower($array["place"])).".php";
            (new Stub('component', 'View\Components', $array))->save();
			(new Stub('component/component', null, $array))->copy('component/component', 'Resources/views/'.strtolower($array["place"]).'/components/'.strtolower($array['component']).'.blade');
			$this->info('Create Component');
			$this->line('App/Modules/'.$array["module"].'/'.$array['fileLocation']);
			$this->newLine();
			$path = app_path('Modules/'.$array["module"].'/Providers/ComponentServiceProvider.php');
			(new File($path))
			->findText('#USE COMPONENT')
            ->writeText("use App\Modules\\".$array["module"]."\View\Components\\".$array['component'].ucfirst(strtolower($array["place"])).";")

			->findText('#BIND COMPONENTS')
            ->writeText("\t\t\t".$array['component'].ucfirst(strtolower($array["place"]))."::class,");
        }
    }
}
