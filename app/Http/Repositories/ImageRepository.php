<?php

namespace App\Http\Repositories;

use App\Image;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
    private $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function storeImage($content, $path, $size)
    {
        $conditional = Storage::disk('s3')->put($path, $content);
        if (!$conditional) {
            return false;
        }
        Storage::disk('s3')->setVisibility($path, 'public');

        return $this->model->create([
            'path' => $path,
            'title' => 'cover',
            'size' => $size
        ]);
    }
}
