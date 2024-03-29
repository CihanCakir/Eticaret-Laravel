<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class urun extends Model
{
    use SoftDeletes;
    protected $table = "urun";
    protected $fillable = ['urun_adi','urun_fiyati','urun_detay','slug'];

    const CREATED_AT = 'olusturulma_tarihi';
    const UPDATED_AT = 'degistirilime_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function kategoriler(){
        return $this->belongsToMany('App\Models\Kategori','kategori_urun');
    }
    public function detay(){
        return $this->hasOne('App\Models\UrunTamDetay');
    }
}

