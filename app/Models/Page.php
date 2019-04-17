<?php

namespace App\Models;

use Hemp\Presenter\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Kalnoy\Nestedset\NodeTrait as NestedSet;
use Cocur\Slugify\Slugify;

class Page extends Model
{
    use NestedSet, Presentable;

    /**
     * @var array
     */
    protected $appends = ['label'];

    /**
     * @var array
     */
    protected $guarded = ['_lft', '_rgt'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordering', function ($builder) {
            $builder->defaultOrder();
        });

        static::saving(function (Page $page) {
            if (empty($page->slug)) {
                $page->slug = (new Slugify())->slugify($page->title);
            }
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
     * @return Banner|null
     */
    public function getBannerDataAttribute(): ?\App\ValueObjects\Banner
    {
        if (empty($this->banner_id)) {
            if ($parent = $this->parent) {
                return $parent->banner_data;
            }

            return null;
        }

        return new \App\ValueObjects\Banner($this->banner, $this);
    }

    /**
     * @return bool
     */
    public function getHasSectionImageAttribute(): bool
    {
        return !empty($this->section_image_uuid);
    }

    /**
     * @return string|null
     */
    public function getSectionImageUrlAttribute()
    {
        if ($this->has_section_image) {
            return $this->section_image->file_url;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getLabelAttribute(): string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return string
     */
    public function getMetaTitleAttribute($title)
    {
        return $title ?? $this->title;
    }

    /**
     * @param string|null $description
     * @return string
     */
    public function getMetaDescriptionAttribute($description)
    {
        return (string)$description;
    }

    /**
     * @param string|null $keywords
     * @return string
     */
    public function getMetaKeywordsAttribute($keywords)
    {
        return (string)$keywords;
    }

    /**
     * @return BelongsTo
     */
    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function section_image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'section_image_uuid');
    }

    /**
     * @return bool
     */
    public function isArticle(): bool
    {
        return $this->isLeaf();
    }
}
