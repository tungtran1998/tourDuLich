<?php
namespace App\Repositories\BookTour;

use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class BookTourRepository extends EloquentRepository implements BookTourInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Booktour::class;
    }

    public function getAllBookTour()
    {

        return $this->_model->where('isdeleted',false)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->get();
    }

    public function getOnBookTourByCode($id)
    {
        return $this->_model->where('book_code',$id)->where('isdeleted',false)->first();
    }

    public function countBookTourByMonthYear($month, $year)
    {
        return $this->_model->where('isdeleted',0)->whereMonth('transaction_date', $month)->whereYear('transaction_date', $year)->count();
    }

    public function revenueBookTourByYear($year)
    {
        return $this->_model->where('isdeleted',0)->where('status','>=',1)->whereYear('transaction_date', $year)->sum('total_amount');
    }

    public function revenueBookTourByMonth($month,$year)
    {
        return $this->_model->where('isdeleted',0)->where('status','>=',1)->whereMonth('transaction_date',$month)->whereYear('transaction_date', $year)->sum('total_amount');
    }

    public function getAllRoomAboutToCheckOut()
    {
        $year=  Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $day = $day + 1;

        return $this->_model->where('isdeleted',0)->where('status','>=',2)->whereMonth('check_out_date',$month)->whereYear('check_out_date', $year)->whereDay('check_out_date', $day)->get();

    }

    

}