<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\ImageRepository;
use App\Services\Contracts\ImageServiceInterface;
use Exception;
use PhpParser\Node\Expr\Empty_;

class ImageService implements ImageServiceInterface
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    private function store(Request $request, $s3Path, $subPath)
    {
        $content = file_get_contents($request->image_file->path());
        $path = $s3Path . auth()->user()->email . $subPath . $request->image_file->getClientOriginalName();
        $size = $request->image_file->getSize();

        return $this->imageRepository->storeImage($content, $path, $size);
    }

    public function storeCover(Request $request, $s3Path)
    {
        return $this->store($request, $s3Path , "covers");
    }

    public function storeImage(Request $request, $s3Path)
    {
        return $this->store($request, $s3Path , "images");
    }

    public function storeImageInspection(Request $request, $s3Path, $idInspecao)
    {
        if(!empty($idInspecao))
        {
            return $this->store($request, $s3Path , "inspection/". $idInspecao."/images/");
        }
        throw new Exception("Invalid idInspecao");
    }
}
