<?php


namespace App\Services\Contracts;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Repositories\InspectionRepository;

interface InspectionServiceInterface
{
    public function storeInspection($inspection, $cover);
}
