<?php


namespace App\Services;

use App\Http\Repositories\AppConfigRepository;




class AppConfigService
{

    protected $appConfigRepository;

    public function __construct(AppConfigRepository $AppConfigRepository)
    {
        $this->appConfigRepository = $AppConfigRepository;
    }

    public function lastConfig()
    {
        return $this->appConfigRepository->lastConfig();
    }

    public function store($appConfig)
    {
        return $this->appConfigRepository->store($appConfig);
    }

    public function welcomeUrl()
    {
        return $this->appConfigRepository->welcomeUrl();
    }
}
