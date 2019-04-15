<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Quote extends Model
{
    protected $guarded = ['id'];

    /**
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_uuid) {
            return $this->image->file_url;
        }

        return null;
    }

    /**
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_uuid');
    }
}
