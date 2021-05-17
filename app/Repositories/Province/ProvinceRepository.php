<?php
namespace App\Repositories\Province;

use App\Repositories\EloquentRepository;

class ProvinceRepository extends EloquentRepository implements ProvinceInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Province::class;
    }    

    public function countProvince()
    {
    	return $this->_model->where('isdeleted',0)->count();
    }
}