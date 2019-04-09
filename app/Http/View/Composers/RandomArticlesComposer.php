<?php

namespace App\Http\View\Composers;

use App\Repositories\PageRepository;
use Illuminate\View\View;

class RandomArticlesComposer
{
    /**
     * @var PageRepository
     */
    protected $repository;

    /**
     * @param PageRepository $repository
     */
    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('pages', $this->repository->getRandomArticles());
    }
}