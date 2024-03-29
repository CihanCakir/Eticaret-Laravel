<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Kategori extends Model
{
    use SoftDeletes;

    protected $table = "kategori";
    protected $fillable = ['kategori_adi','slug'];
    const CREATED_AT = 'olusturulma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function urunler(){
        return $this->belongsToMany('App\Models\urun','kategori_urun');
    }
}
