<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  UrunTamDetay extends Model
{
    protected  $table = "urun_tamdetay";
    public $timestamps = false;
    public function urun(){
        return $this->belongsTo('App\Models\urun');
    }
}
