<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Butschster\Head\Facades\Meta;

class PagesController extends Controller
{
    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        $page->load('ancestors');

        Meta::prependTitle($page->meta_title)
            ->setDescription($page->meta_description)
            ->setKeywords($page->meta_keywords);

        return view('page.show', compact('page'));
    }
}
