<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Multimedia\Multistore\Support\Stub;

class ModulesClassCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:class.create';

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
            $array['class'] = $this->ask('Enter Class name');

            $array["extended"] = $this->confirm('Added to extended module?', false);
			$array['fileLocation'] = "Http/Classes/".$array['class'].".php";
            $array['namespace'] = "App\\".($array["extended"] ? "Extended\\" : "")."Modules\\".ucfirst(strtolower($array["module"]))."\Http\Classes\\".$array['class'];

			(new Stub('classes/class', 'Classes', $array))->save();
        }
    }
}
