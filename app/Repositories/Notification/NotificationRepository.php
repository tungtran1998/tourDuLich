<?php
namespace App\Repositories\Notification;

use App\Repositories\EloquentRepository;

class NotificationRepository extends EloquentRepository implements NotificationInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Notification::class;
    }

    public function findNotification($id)
    {
    	return $this->_model->where('id', $id)->first();
    }    
}