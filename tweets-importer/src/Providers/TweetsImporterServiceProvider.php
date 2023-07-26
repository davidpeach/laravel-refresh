<?php

namespace TweetsImporter\Providers;

use Illuminate\Support\ServiceProvider;

class TweetsImporterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TweetsImporter::class, function () {
            return new TweetsImporter();
        });
    }

    public function boot()
    {
        //
    }
}
