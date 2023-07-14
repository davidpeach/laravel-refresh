<?php

namespace WPImport\Providers;

use Illuminate\Support\ServiceProvider;
use WPImport\Importer;

class WPImporterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Importer::class, function () {
            return new Importer();
        });
    }

    public function boot()
    {
        //
    }
}
