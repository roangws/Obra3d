<?php
namespace App\Http\Repositories;

use App\Inspection;

class InspectionRepository 
{
	protected $model;

	public function __construct(Inspection $model)
	{
		$this->model = $model;
	}

	public function findAll()
	{
		return $this->model->all();
	}    
	
	public function storeInspection($data, $cover){

		$data = (array)$data;

		$data['inspection_date'] = new \DateTime($data['inspection_date']);
		
		$this->model = $this->model->create($data);

		$this->model->cover()->associate($cover);

		$this->model->save();

		return $this->model;
	}

	
    
}