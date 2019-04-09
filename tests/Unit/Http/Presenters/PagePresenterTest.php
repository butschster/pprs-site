<?php

namespace Tests\Unit\Http\Presenters;

use App\Http\View\Presenters\PagePresenter;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagePresenterTest extends TestCase
{
    use RefreshDatabase;

    function test_check_if_page_is_article()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $subChild = factory(Page::class)->create();
        $page->appendNode($child);
        $child->appendNode($subChild);

        $page1 = factory(Page::class)->create();
        $child1 = factory(Page::class)->create();
        $page1->appendNode($child1);

        $this->assertTrue($subChild->present(PagePresenter::class)->isArticle());
        $this->assertFalse($page->present(PagePresenter::class)->isArticle());
        $this->assertFalse($child->present(PagePresenter::class)->isArticle());

        $this->assertFalse($page1->present(PagePresenter::class)->isArticle());
        $this->assertTrue($child1->present(PagePresenter::class)->isArticle());
    }

    function test_get_children_pages()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $child2 = factory(Page::class)->create();
        $page1 = factory(Page::class)->create();
        $page->appendNode($child);
        $page1->appendNode($child2);

        $children = $page->present(PagePresenter::class)->getChildren()->pluck('id');

        $this->assertTrue($children->contains($child->id));
        $this->assertFalse($children->contains($child2->id));
        $this->assertFalse($children->contains($page1->id));
    }
}