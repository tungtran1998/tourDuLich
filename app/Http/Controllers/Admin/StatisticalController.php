<?php

namespace App\Http\Controllers\Admin;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BookTour\BookTourInterface;
use App\Repositories\Tour\TourInterface;

class StatisticalController extends Controller
{

	protected $bookingRP;
	protected $roomRP;
	protected $booktourRP;
	protected $tourRP;

	public function __construct(BookTourInterface $bookTourInterface, TourInterface $tourInterface)
	{
		$this->middleware('permission:revenue-statistics-by-year', ['only' => ['statistic','revenueStatistics']]);
		$this->middleware('permission:revenue-statistics-by-month', ['only' => ['statisticMonth','revenueStatisticsMonth']]);
		$this->booktourRP = $bookTourInterface;
		$this->tourRP = $tourInterface;
	}

	public function statistic()
	{
		return view('admin.statistic.index');
	}
	public function revenueStatistics()
	{

		$result = array();
		$year=  Carbon::now()->year;
		$month = Carbon::now()->month;
		$arrRevenue = array();
		$year = $year - 3;
		for($i = 0; $i <= 3; $i++ ){
			$arrYear[$i] = $year + $i;
			$arrRevenue[] = $this->booktourRP->revenueBookTourByYear($arrYear[$i]);
		}
		$result = [$arrYear, $arrRevenue];
		return response()->json($result);
	}

	public function statisticMonth()
	{
		return view('admin.statistic.revenueMonth');
	}

	public function revenueStatisticsMonth()
	{
		$result = array();
		$month = Carbon::now()->month;
		$year=  Carbon::now()->year;
		$arrMonth = array();
		$arrMonth = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		$arrMonthinYear = array();
		$arrRevenue = array();
		for($i = 0; $i <= $month; $i++ ){
			$arrMonthinYear[$i] = $arrMonth[$i];
			$arrRevenue[] = $this->booktourRP->revenueBookTourByMonth($i,$year);
		}
		$result = [$arrMonthinYear,$arrRevenue];
		return response()->json($result);
	}

	public function calendar()
	{
		$tasks = $this->tourRP->getAllTour();

		return view('admin.statistic.calendar',compact('tasks'));
	}
}
