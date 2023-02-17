<?php

namespace App\Http\Repositories;

use App\AppConfig;

class AppConfigRepository
{
    private $model;

    public function __construct(AppConfig $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function lastConfig()
    {
        return $this->model->latest()->first();
    }

    public function store($appConfig)
    {
        return $this->model->create($appConfig);
    }

    public function welcomeUrl()
    {
        return $this->model->select('welcome_video_url')->latest()->first();
    }
}
