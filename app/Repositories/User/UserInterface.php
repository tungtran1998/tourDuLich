<?php
namespace App\Repositories\User;

interface UserInterface
{
    public function countUserClient();

    public function countUserClientByMonthAndYear($month, $year);
}