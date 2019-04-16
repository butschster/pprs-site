<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
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

    public function getFormattedDateAttribute()
    {
        return $this->created_at->locale('ru')->format('d F Y');
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
}
