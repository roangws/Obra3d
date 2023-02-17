<?php

namespace App\Services;

use App\Services\Contracts\MediaServiceInterface;

class MediaService implements MediaServiceInterface
{

    public function storeMedia($dataFieldsMedia)
    {
        return "Sim!";
    }
}
