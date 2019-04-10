<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Quote extends Model
{
    /**
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }
}
