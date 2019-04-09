<?php

namespace App\Providers;

use App\Http\View\Composers\LastNewsComposer;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\RandomArticlesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout._partials.menu', MenuComposer::class);
        View::composer('layout._partials.random_articles', RandomArticlesComposer::class);
        View::composer('layout._partials.last_news', LastNewsComposer::class);
    }
}
