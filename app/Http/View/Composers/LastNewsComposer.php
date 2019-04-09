<?php

namespace App\Http\View\Composers;

use App\Models\News;
use Illuminate\View\View;

class LastNewsComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('news', News::latest()->take(5)->get());
    }
}