<?php

namespace App\Http\Repositories;

use App\Construction;

class ConstructionRepository 
{
	private $model;

	public function __construct(Construction $model)
	{
		$this->model = $model;
	}

	public function findAll()
	{
		return $this->model->all();
	}
	
	public function constructionWithInspections($construction_id){
        return $this->model->where('id',$construction_id)->with(['inspections.cover', 'address','cover'])->first();
    }

}