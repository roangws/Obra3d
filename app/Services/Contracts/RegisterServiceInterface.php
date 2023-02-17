<?php

namespace App\Services\Contracts;


use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;

interface RegisterServiceInterface
{
    public function register(RegistrationRequest $request): array;
}
