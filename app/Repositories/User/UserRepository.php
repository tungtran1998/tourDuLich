<?php
namespace App\Repositories\User;

use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function countUserClient()
    {
    	return $this->_model->where('isdeleted',0)->where('status',0)->count();
    }

    public function countUserClientByMonthAndYear($month,$year)
    {
        return $this->_model->where('isdeleted',0)->where('status',0)->whereMonth('created_at',$month)->whereYear('created_at', $year)->count();
    }    
}