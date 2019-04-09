<?php

namespace Tests\Unit\Models;

use App\Models\Page;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_path()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $subChild = factory(Page::class)->create();
        $page->appendNode($child);
        $child->appendNode($subChild);

        $this->assertEquals($page->slug . '/' . $child->slug . '/' . $subChild->slug, $subChild->path());
        $this->assertEquals($page->slug . '/' . $child->slug, $child->path());
    }

    function test_find_page_by_path()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $subChild = factory(Page::class)->create();
        $page->appendNode($child);
        $child->appendNode($subChild);

        $this->assertTrue(
            $child->is(Page::findByPathOrFail($child->path()))
        );

        $this->assertTrue(
            $subChild->is(Page::findByPathOrFail($subChild->path()))
        );
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    function test_throw_an_exception_if_page_by_path_not_found()
    {
        Page::findByPathOrFail('hello-world');
    }

    function test_it_has_url()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();

        $this->assertEquals(url($child->path()), $child->url());
        $this->assertEquals(url($page->path()), $page->url());
    }

    function test_check_if_it_has_a_banner()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create();
        $page->appendNode($child);

        $this->assertTrue($page->hasBanner());
        $this->assertTrue($child->hasBanner());

        $page = factory(Page::class)->create([
            'banner' => null,
        ]);
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertFalse($page->hasBanner());
        $this->assertFalse($child->hasBanner());

        $page = factory(Page::class)->create([
            'banner' => null,
        ]);
        $child = factory(Page::class)->create();
        $page->appendNode($child);

        $this->assertFalse($page->hasBanner());
        $this->assertTrue($child->hasBanner());

        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertTrue($page->hasBanner());
        $this->assertTrue($child->hasBanner());
    }

    function test_it_can_have_top_banner()
    {
        $page = factory(Page::class)->create();

        $this->assertNotNull($page->bannerUrl());
    }

    function test_if_it_does_not_have_banner_it_should_get_from_parent_page()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertEquals($page->bannerUrl(), $child->bannerUrl());
    }

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

        $this->assertTrue($subChild->isArticle());
        $this->assertFalse($page->isArticle());
        $this->assertFalse($child->isArticle());

        $this->assertFalse($page1->isArticle());
        $this->assertTrue($child1->isArticle());
    }

    function test_check_if_it_has_section_image()
    {
        $page = factory(Page::class)->create();
        $this->assertTrue($page->hasSectionImage());

        $page = factory(Page::class)->create([
            'section_image' => null,
        ]);

        $this->assertFalse($page->hasSectionImage());
    }

    function test_it_has_section_image_url()
    {
        $page = factory(Page::class)->create();
        $this->assertNotNull($page->sectionImageUrl());

        $page = factory(Page::class)->create([
            'section_image' => null,
        ]);
        $this->assertNull($page->sectionImageUrl());
    }
}
