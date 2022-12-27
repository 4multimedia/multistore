<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Multimedia\Multistore\Support\Stub;

class ModulesControllerCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:controller.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new controller in exists module';

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
            $controller = $this->ask('Enter controller name');

            $array["extended"] = $this->confirm('Added to extended module?', false);
			$frontend = $this->confirm('Added to frontend?', false);
            $backend = $this->confirm('Added to backend?', false);
			$api = $this->confirm('Added to api?', false);

            $array['namespace'] = "App\\".($array["extended"] ? "Extended\\" : "")."Modules\\".ucfirst(strtolower($array["module"]))."\Http\Controllers\\".($backend ? "Backend" : "Frontend");
            $array['class'] = $controller."Controller";

			if ($frontend) {
            	$array['fileLocation'] = "Http/Controllers/Frontend/".$array['class'].".php";
            	(new Stub('controllers/controller', 'Controllers', $array))->save();
				$this->info('Create Frontend Controller');
				$this->line('App/Modules/'.$array["module"].'/'.$array['fileLocation']);
				$this->newLine();
			}

			if ($backend) {
            	$array['fileLocation'] = "Http/Controllers/Backend/".$array['class'].".php";
            	(new Stub('controllers/controller', 'Controllers', $array))->save();
				$this->info('Create Backend Controller');
				$this->line('App/Modules/'.$array["module"].'/'.$array['fileLocation']);
				$this->newLine();
			}

			if ($api) {
            	$array['fileLocation'] = "Http/Controllers/Api/".$array['class'].".php";
            	(new Stub('controllers/controller', 'Controllers', $array))->save();
				$this->info('Create Api Controller');
				$this->line('App/Modules/'.$array["module"].'/'.$array['fileLocation']);
				$this->newLine();
			}
        }
    }
}
