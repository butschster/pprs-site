<?php

namespace App\Http\Controllers;

use App\Models\News;
use Butschster\Head\Facades\Meta;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(8);

        return view('news.index', compact('news'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        Meta::prependTitle($news->meta_title)
            ->setDescription($news->meta_description)
            ->setKeywords($news->meta_keywords);

        return view('news.show', compact('news'));
    }
}
