<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use \Kalnoy\Nestedset\NodeTrait;

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
     * @return string|null
     */
    public function bannerUrl(): ?string
    {
        if (empty($this->banner)) {
            if ($this->parent) {
                return $this->parent->bannerUrl();
            }

            return null;
        }

        return Storage::url($this->banner);
    }

    /**
     * @return bool
     */
    public function hasBanner(): bool
    {
        if (empty($this->banner)) {
            if ($this->parent) {
                return $this->parent->hasBanner();
            }

            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isArticle(): bool
    {
        return $this->isLeaf();
    }

    /**
     * @return bool
     */
    public function hasSectionImage(): bool
    {
        return !empty($this->section_image);
    }

    /**
     * @return string|null
     */
    public function sectionImageUrl(): ?string
    {
        if ($this->hasSectionImage()) {
            return Storage::url($this->section_image);
        }

        return null;
    }
}
