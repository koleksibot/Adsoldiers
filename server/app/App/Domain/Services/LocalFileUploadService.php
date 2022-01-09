<?php

namespace App\App\Domain\Services;

use Illuminate\Support\Facades\Storage;

class LocalFileUploadService
{
    protected $file;
    protected $file_name;
    protected $file_type;
    protected $path;

    public function __construct($file)
    {
        $this->file = $file;
        $this->setDefaults();
    }

    public function setDefaults()
    {
        // if the media path and type
        if (gettype($this->file) == 'array' && head($this->file)->getClientOriginalExtension() == 'mp4'
            || gettype($this->file) == 'object' && $this->file->getClientOriginalExtension() == 'mp4') {
            // if the media type is mp4(video) change the sotring path to videos folder
            $this->path = env('VIDEOS_STORING_PATH');
            $this->file_type = 'video';
            return $this;
        }

        $this->path = env('IMAGES_STORING_PATH');
        $this->file_type = 'image';
        return $this;
    }

    public function saveMany()
    {
        foreach ($this->file as $file) {
            $this->file_name[] = Storage::disk('nuxt')->put($this->path, $file);
        }
        return $this;
    }

    public function save()
    {
        $this->file_name = Storage::disk('nuxt')->put($this->path, $this->file);

        return $this;
    }

    public function generateFileName($file)
    {
        return $file->hashName();
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function getFileType()
    {
        return $this->file_type;
    }
}
