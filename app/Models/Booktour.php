<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booktour extends Model
{


    protected $table = 'book_tours';
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function tour_book(){
        return $this->belongsTo('App\Models\Tour','tour_id','id');
    }
    public function createByAdmin(){
        return $this->belongsTo('App\Models\Admin','created_by','id');
    }
    public function updateByAdmin(){
        return $this->belongsTo('App\Models\Admin','updated_by','id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
