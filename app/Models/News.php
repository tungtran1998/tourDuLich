<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class News extends Model implements AuditableContract, Searchable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $table = 'news';
    protected $guarded = ['id'];
    protected $timestamp = true;

     
    public function createByAdmin(){
        return $this->belongsTo('App\Models\Admin','created_by','id');
    }
    public function updateByAdmin(){
        return $this->belongsTo('App\Models\Admin','updated_by','id');
    }
    public function provences(){
        return $this->belongsTo('App\Models\Province','province_id','id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('/news/', $this->id);
        return new SearchResult(
            $this,
            $this->title,
            $url
         );
    }

}
