<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDay extends Model
{
    //
    protected $table = 'specialday_booking';
    protected $guarded = ['id'];
    protected $timestamp = true;
}
