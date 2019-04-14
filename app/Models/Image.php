<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class Image extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = ['file_path'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Image $image) {
            $image->uuid = Uuid::uuid4();
        });

        static::deleted(function (Image $image) {
            Storage::disk($image->disk)->delete($image->file_path);
        });
    }

    /**
     * @return string
     */
    public function getFileAttribute(): string
    {
        return Storage::disk($this->disk)->path($this->file_path);
    }

    /**
     * @return string
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->file_path);
    }

    /**
     * @param UploadedFile $file
     * @throws \Exception
     */
    public function setFileAttribute(UploadedFile $file)
    {
        $this->upload($file, class_basename($this->section_type));
    }

    /**
     * @param UploadedFile $file
     * @param string $section
     * @return $this
     */
    public function upload(UploadedFile $file, string $section)
    {
        $this->disk = Storage::getDefaultDriver();

        $this->size = $file->getSize();
        $this->mime = $file->getMimeType();
        $this->file_path = $file->storePublicly('images/'.strtolower($section));

        $this->save();

        return $this;
    }
}
