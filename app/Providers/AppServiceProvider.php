<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {
            return new MailchimpNewsletter(
                (new ApiClient())->setConfig([
                    'apiKey' => config('services.mailchimp.key'),
                    'server' => config('services.mailchimp.server_prefix'),
                ])
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'album' => 'App\Models\Album',
            'article' => 'App\Models\Article',
            'note' => 'App\Models\Note',
        ]);

        Paginator::defaultView('vendor.pagination.default');
    }
}
