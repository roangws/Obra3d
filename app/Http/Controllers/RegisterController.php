<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Services\Contracts\RegisterServiceInterface;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterServiceInterface $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegistrationRequest $request)
    {
        $result = $this->registerService->register($request);
        return response()->json($result, $result['code']);
    }
}
