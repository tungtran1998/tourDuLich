<?php
namespace App\Repositories\News;

use App\Repositories\EloquentRepository;

class NewsRepository extends EloquentRepository implements NewsInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\News::class;
    }

    public function countNew()
    {
    	return $this->_model->where('isdeleted',0)->count();
    }    
}