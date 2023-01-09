<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Multimedia\Multistore\Support\Stub;

class ModulesTransaltionMerge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:translation.merge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merge translation files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // open files translations
        $dir_language_base = base_path('resources/lang');
        $json_language_file = array_diff(scandir($dir_language_base), array('..', '.'));
        $languages = ['pl', 'en', 'de'];

        foreach($languages as $language) {
            //$a = File::getRequire(__DIR__ . '/../Core/resources/lang/pl/validation.php');
            //print_r($a); die;
            $array = [];
            $dir = __DIR__ . '/../Core/resources/lang/'.$language;
            if (File::exists($dir)) {
                $files = File::files($dir);
                foreach($files as $file) {
                    $key = $file->getFilenameWithoutExtension();
                    $fileName = $file->getFilename();

                    $array[$key] = File::getRequire($dir.'/'.$fileName);
                    $this->info("Generate: $language - $key");
                }

                $json = json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

            }

            @mkdir(__DIR__ . '/../data');
            @mkdir(__DIR__ . '/../data/json');
            @mkdir(__DIR__ . '/../data/json/lang');
            file_put_contents(__DIR__ . '/../data/json/lang/'.$language.'.json', $json);
        }
    }
}
