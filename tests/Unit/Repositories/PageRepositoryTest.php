<?php

namespace Tests\Unit\Repositories;

use App\Models\Page;
use App\Repositories\PageRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_menu_pages()
    {
        $page = factory(Page::class)->create();
        $page1 = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $child1 = factory(Page::class)->create();

        $page->children()->save($child);
        $page1->children()->save($child1);

        $repository = new PageRepository();

        $menu = $repository->getMenu();
    }
}
