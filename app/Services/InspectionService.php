<?php


namespace App\Services;

use App\Image;
use App\Inspection;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\InspectionRepository;
use App\Services\Contracts\InspectionServiceInterface;


class InspectionService implements InspectionServiceInterface
{
    protected $inspectionRepository;

    public function __construct(InspectionRepository $inspectionRepository)
    {
        $this->inspectionRepository = $inspectionRepository;
    }

    public function storeInspection($data, $cover)
    {

        return $this->inspectionRepository->storeInspection(json_decode($data['inspection']), $cover);
    }
}
