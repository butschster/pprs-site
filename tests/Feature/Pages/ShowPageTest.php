<?php

namespace Tests\Feature\Pages;

use App\Models\Page;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowPageTest extends TestCase
{
    use RefreshDatabase;

    function test_a_page_can_be_showed()
    {
        $page = factory(Page::class)->create();

        $this->get($page->url())
            ->assertSee($page->title)
            ->assertSee($page->banner_url)
            ->assertSee($page->meta_title)
            ->assertSee($page->meta_description)
            ->assertSee($page->meta_keywords);
    }

    function test_a_subpage_can_be_showed()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();

        $page->appendNode($child);

        $this->get($child->url())
            ->assertSee($child->title)
            ->assertSee($child->meta_title)
            ->assertSee($child->meta_description)
            ->assertSee($child->meta_keywords);
    }

    function test_a_page_has_breadcrumbs()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();

        $page->appendNode($child);

        $this->get($child->url())
            ->assertSee($child->title)
            ->assertSee($page->title)
            ->assertSee($page->url())
            ->assertSee(route('home'))
            ->assertSee('Главная страница');
    }
}
