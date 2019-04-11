<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function show()
    {
        $sitemap = new Sitemap();

        $sitemap->add(Url::create(route('home')));
        $sitemap->add(Url::create(route('subscribe.form')));
        $pages = Page::get();
        $news = News::latest()->get();

        foreach ($pages as $page) {
            $sitemap->add(
                Url::create($page->url())->setLastModificationDate($page->updated_at)
            );
        }

        $sitemap->add(Url::create(route('news.index')));
        foreach ($news as $item) {
            $sitemap->add(
                Url::create($item->url())->setLastModificationDate($item->updated_at)
            );
        }

        return new Response(
            $sitemap->render(),
            200,
            [
                'Content-type' => 'text/xml',
            ]
        );
    }
}
