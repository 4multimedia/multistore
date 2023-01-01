<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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

        if (!is_dir($dir_language_base)) {
            mkdir($dir_language_base);
            $this->info('Created directory:');
            $this->line($dir_language_base);
            $this->newLine();
        }

        // language list
        foreach($languages as $language) {
            $file_language = $dir_language_base.'/'.$language.'.json';
            if (file_exists($file_language)) {

            } else {
                $this->info('Created file:');
                $this->line($file_language);
                $this->newLine();

                file_put_contents($file_language, null);
            }


        }
    }
}
