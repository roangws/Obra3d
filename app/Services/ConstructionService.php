<?php


namespace App\Services;

use App\Http\Repositories\ConstructionRepository;




class ConstructionService{
    
    protected $constructionRepository;

    public function __construct(ConstructionRepository $constructionRepository){
        $this->constructionRepository = $constructionRepository;
    }

    public function constructionWithInspections($construction_id){
        return $this->constructionRepository->constructionWithInspections($construction_id);
    }
}