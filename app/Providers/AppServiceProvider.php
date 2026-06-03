<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Global view composers
        View::composer('layouts.public', function ($view) {
            $view->with('studioName', config('studio.name', 'Chinhari Tattoo Studio'));
        });

        // Default SEO defaults
        SEOMeta::setTitleDefault('Chinhari Tattoo Studio | Best in Raipur');
        SEOMeta::setTitleSeparator(' | ');
        OpenGraph::setSiteName('Chinhari Tattoo Studio');
    }
}
