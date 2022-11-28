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
        $array["module"] = $this->ask('Enter module name');
        $isDir = is_dir(app_path('Modules/'.$array["module"]));
        if (!$isDir) {
            $this->error('Wrong module name');
        } else {
            $controller = $this->ask('Enter controller name');

            $array["extended"] = $this->confirm('Added to extended module?', false);
            $backend = $this->confirm('Added to backend?', false);

            $array['namespace'] = "App\\".($array["extended"] ? "Extended\\" : "")."Modules\Layout\Http\Controllers\\".($backend ? "Backend" : "Frontend");
            $array['class'] = $controller."Controller";
            $array['fileLocation'] = "Http/Controllers/".($backend ? "Backend" : "Frontend")."/".$array['class'].".php";

            return (new Stub('controllers/controller', 'Controllers', $array))->save();
        }
    }
}
