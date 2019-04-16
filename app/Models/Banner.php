<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (Banner $banner) {
            $banner->image->delete();
            Page::where('banner_id', $banner->id)->update(['banner_id' => null]);
        });
    }

    /**
     * @var array
     */
    protected $with = ['image'];

    /**
     * @var array
     */
    protected $fillable = ['content', 'image_uuid'];

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
