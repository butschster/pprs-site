<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Collection;

class PageRepository
{
    public function getMenu(): Collection
    {
        return Page::whereIsRoot()->with('children', 'children.ancestors', 'ancestors')->get();
    }
}