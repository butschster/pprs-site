<?php

namespace App\ValueObjects;

use App\Models\Page;

class Banner
{
    /**
     * @var \App\Models\Banner
     */
    protected $banner;
    /**
     * @var Page
     */
    protected $page;

    /**
     * @param \App\Models\Banner $banner
     * @param Page $page
     */
    public function __construct(\App\Models\Banner $banner, Page $page)
    {
        $this->banner = $banner;
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->page->title;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->banner->content;
    }

    /**
     * @return string
     */
    public function imageUrl()
    {
        return $this->banner->image_url;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->page->url();
    }

    /**
     * @param Page $page
     * @return bool
     */
    public function isPage(Page $page): bool
    {
        return $this->page->is($page);
    }
}