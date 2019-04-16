<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Collection;

class PageRepository
{
    protected $cachedMenu;

    /**
     * @return Collection
     */
    public function getMenu(): Collection
    {
        if ($this->cachedMenu) {
            return $this->cachedMenu;
        }

        return $this->cachedMenu = Page::whereIsRoot()
            ->defaultOrder()
            ->with('children', 'children.ancestors', 'ancestors')
            ->get();
    }

    /**
     * @return Collection
     */
    public function getRandomArticles(): Collection
    {
        return Page::with('parent', 'ancestors')->whereIsLeaf()->whereNotNull('section_image_uuid')->inRandomOrder()->take(3)->get();
    }
}