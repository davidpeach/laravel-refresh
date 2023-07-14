<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use WPImport\Importer;

class WordPressImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import:wp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Importer $importer)
    {
        $importer->withFile(storage_path('wp.xml'))->import();
    }
}
