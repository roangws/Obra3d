<?php


namespace App\Services\Contracts;

use Illuminate\Http\Request;




interface ImageServiceInterface
{
    public function storeCover(Request $request, $s3Path);
    public function storeImage(Request $request, $s3Path);
    public function storeImageInspection(Request $request, $s3Path, $idInspecao);
}
