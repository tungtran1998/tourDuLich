<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
	use Notifiable;
    use SoftDeletes;
    protected $table = 'notifications';
    public $timestamp = true;
    
}
