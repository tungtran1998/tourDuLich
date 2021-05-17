<?php
namespace App\Repositories\Admin;

use App\Repositories\EloquentRepository;

class AdminRepository extends EloquentRepository implements AdminInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Admin::class;
    }    
}