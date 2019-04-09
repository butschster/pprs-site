<?php

namespace Tests\Unit\Repositories;

use App\Models\Page;
use App\Repositories\PageRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_menu_pages()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $subChild = factory(Page::class)->create();

        $page->appendNode($child);
        $child->appendNode($subChild);

        $repository = new PageRepository();

        $menu = $repository->getMenu();

        $this->assertTrue($menu->contains($page));
        $this->assertTrue($menu->where('id', $page->id)->first()->children->contains($child));
    }
}
