<?php

namespace App\Http\Controllers;

use App\Models\News;
use Butschster\Head\Facades\Meta;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(8);

        Meta::prependTitle('Новости')
            ->setDescription('Новое на портале о ППРС')
            ->setPaginationLinks($news);

        return view('news.index', compact('news'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('news');
        $og->setType('article')
            ->setSiteName('My awesome site')
            ->setTitle($news->meta_title)
            ->setUrl($news->url())
            ->addImage(asset('images/top-banners-orange-xl-main.png'));

        Meta::prependTitle($news->meta_title)
            ->setDescription($news->meta_description)
            ->setKeywords($news->meta_keywords)
            ->registerPackage($og);

        return view('news.show', compact('news'));
    }
}
