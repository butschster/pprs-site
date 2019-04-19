<?php

namespace App\Http\Controllers;

use App\Http\View\Presenters\PagePresenter;
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

        $page = $page->present(PagePresenter::class);

        if (!$page->isArticle()) {
            $pages = $page->getChildren()->paginate(5);
        } else {
            $pages = null;
        }

        return view('page.show', compact('page', 'pages'));
    }
}
