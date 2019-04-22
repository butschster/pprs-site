<?php

namespace App\Models;

use App\Services\TextParser\QuoteParser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Date\Date;

class News extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::saved(function (News $news) {
            Cache::forget('news.text-parsed'.$news->id);
        });
    }

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return string
     */
    public function url()
    {
        return route('news.show', $this);
    }

    /**
     * @return mixed|string
     */
    public function getFormattedDateAttribute()
    {
        return Date::make($this->created_at)->format('d M Y');
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
     * @return mixed
     */
    public function getParsedTextAttribute()
    {
        return Cache::rememberForever('news.text-parsed'.$this->id, function () {
            return (new QuoteParser())->parse($this->text);
        });
    }
}
