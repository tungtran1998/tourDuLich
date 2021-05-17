<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feedback extends Model
{
    //
    use Notifiable;
    
    protected $table = 'feedbacks';
    protected $guarded = ['id'];
    protected $timestamp = true;
}
