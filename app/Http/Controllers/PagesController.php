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

        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('article');
        $og->setType('article')
            ->setTitle($page->meta_title)
            ->setDescription($page->meta_description)
            ->setUrl($page->url());

        if ($page->has_section_image) {
            $og->addImage($page->section_image_url);
        } elseif ($banner = $page->banner_data) {
            $og->addImage($banner->imageUrl());
        }

        Meta::setTitle($page->meta_title)
            ->setDescription($page->meta_description)
            ->setKeywords($page->meta_keywords)
            ->registerPackage($og);

        $page = $page->present(PagePresenter::class);

        if (!$page->isArticle()) {
            $pages = $page->getChildren()->paginate(5);
        } else {
            $pages = null;
        }

        return view('page.show', compact('page', 'pages'));
    }
}
