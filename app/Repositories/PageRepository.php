<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Collection;

class PageRepository
{
    /**
     * @return Collection
     */
    public function getMenu(): Collection
    {
        return Page::whereIsRoot()->with('children', 'children.ancestors', 'ancestors')->defaultOrder()->get();
    }

    /**
     * @return Collection
     */
    public function getRandomArticles(): Collection
    {
        return Page::with('parent', 'ancestors')->whereIsLeaf()->inRandomOrder()->take(3)->get();
    }
}