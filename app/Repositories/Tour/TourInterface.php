<?php
namespace App\Repositories\Tour;

interface TourInterface
{
	public function countTour();
	public function findNameTour($id);
	public function getAllTour();
}