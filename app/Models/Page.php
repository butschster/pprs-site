<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Hemp\Presenter\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait as NestedSet;

class Page extends Model
{
    use NestedSet, Presentable;

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Page $page) {
            if (empty($page->slug)) {
                $page->slug = $page->title;
            }

            $page->slug = (new Slugify())->slugify($page->slug);
        });
    }

    /**
     * Поиск страницы по пути
     *
     * @param string $path
     * @return Page
     */
    public static function findByPathOrFail(string $path): Page
    {
        $currentPageSlug = Arr::last(explode('/', $path));

        return static::where('slug', $currentPageSlug)->firstOrFail();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Получение пути до страницы
     *
     * @return string
     */
    public function path(): string
    {
        $paths = [];

        foreach ($this->ancestors as $page) {
            $paths[] = $page->slug;
        }

        $paths[] = $this->slug;

        return implode('/', $paths);
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('page.show', $this->path());
    }

    /**
     * @return bool
     */
    public function getHasBannerAttribute(): bool
    {
        if (empty($this->banner)) {
            if ($parent = $this->parent) {
                return $parent->has_banner;
            }

            return false;
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getBannerUrlAttribute(): ?string
    {
        if (empty($this->banner)) {
            if ($parent = $this->parent) {
                return $parent->banner_url;
            }

            return null;
        }

        return Storage::url($this->banner);
    }

    /**
     * @return bool
     */
    public function getHasSectionImageAttribute(): bool
    {
        return !empty($this->section_image);
    }

    /**
     * @return string|null
     */
    public function getSectionImageUrlAttribute(): ?string
    {
        if ($this->has_section_image) {
            return Storage::url($this->section_image);
        }

        return null;
    }
}
