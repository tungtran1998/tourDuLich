<?php
namespace App\Repositories\BookTour;

interface BookTourInterface
{
    public function getAllBookTour();
    public function getOnBookTourByCode($id);
    public function countBookTourByMonthYear($month, $year);
    public function revenueBookTourByYear($year);
    public function revenueBookTourByMonth($month,$year);
    public function getAllRoomAboutToCheckOut();

}