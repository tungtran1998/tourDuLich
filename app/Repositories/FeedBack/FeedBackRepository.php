<?php
namespace App\Repositories\FeedBack;

use App\Repositories\EloquentRepository;

class FeedBackRepository extends EloquentRepository implements FeedBackInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Feedback::class;
    }

    public function getAllFeedBack()
    {
    	return $this->_model->orderBy('created_at', 'desc')->orderBy('reply_by', 'desc')->get();
    }    
}