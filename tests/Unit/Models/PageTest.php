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

        $this->assertTrue($page->has_banner);
        $this->assertTrue($child->has_banner);

        $page = factory(Page::class)->create([
            'banner' => null,
        ]);
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertFalse($page->has_banner);
        $this->assertFalse($child->has_banner);

        $page = factory(Page::class)->create([
            'banner' => null,
        ]);
        $child = factory(Page::class)->create();
        $page->appendNode($child);

        $this->assertFalse($page->has_banner);
        $this->assertTrue($child->has_banner);

        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertTrue($page->has_banner);
        $this->assertTrue($child->has_banner);
    }

    function test_it_can_have_top_banner()
    {
        $page = factory(Page::class)->create();

        $this->assertNotNull($page->banner_url);
    }

    function test_if_it_does_not_have_banner_it_should_get_from_parent_page()
    {
        $page = factory(Page::class)->create();
        $child = factory(Page::class)->create([
            'banner' => null,
        ]);
        $page->appendNode($child);

        $this->assertEquals($page->banner_url, $child->banner_url);
    }

    function test_check_if_it_has_section_image()
    {
        $page = factory(Page::class)->create();
        $this->assertTrue($page->has_section_image);

        $page = factory(Page::class)->create([
            'section_image' => null,
        ]);

        $this->assertFalse($page->has_section_image);
    }

    function test_it_has_section_image_url()
    {
        $page = factory(Page::class)->create();
        $this->assertNotNull($page->section_image_url);

        $page = factory(Page::class)->create([
            'section_image' => null,
        ]);
        $this->assertNull($page->section_image_ur);
    }
}
