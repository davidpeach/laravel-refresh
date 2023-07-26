<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TweetsImporter\TweetsImporter as Tweets;

class TweetsImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import:tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import tweets from twitter-exported js file.';

    /**
     * Execute the console command.
     */
    public function handle(Tweets $importer)
    {
        $importer->withFile(storage_path('tweest.js'))->import();

        /* $json = json_encode($xml); */

        /* $array = json_decode($json, true); */

        /* collect($array)->each(function ($item) { */
        /*     dump($item); */
        /* }); */
    }
}
