<?php
namespace App\Repositories\Tour;

use App\Repositories\EloquentRepository;

class TourRepository extends EloquentRepository implements TourInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Tour::class;
    } 

    public function countTour()
    {
    	return $this->_model->where('isdeleted',0)->count();
    }

    public function findNameTour($id)
    {
        return $this->_model->where('id',$id)->select('name')->first();
    }

    public function getAllTour()
    {

        return $this->_model->where('isdeleted',false)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->get();
    }
}