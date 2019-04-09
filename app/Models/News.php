<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
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
}
