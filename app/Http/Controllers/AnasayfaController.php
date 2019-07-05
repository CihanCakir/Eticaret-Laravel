<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){

        $isim = 'cihan';
        $soyisim = 'Çakır';
        $isimler = ['Can','Murat','Nazlı','Nesliha'];
        $kullanicilar = [
            ['id'=> 1, 'kullanici_adi'=> 'Can'],
            ['id'=> 2, 'kullanici_adi'=> 'Murat'],
            ['id'=> 3, 'kullanici_adi'=> 'Nazlı'],
            ['id'=> 4, 'kullanici_adi'=> 'Nesliha'],
            ['id'=> 5, 'kullanici_adi'=> 'memo'],
            ['id'=> 6, 'kullanici_adi'=> 'Kero']

        ];
        //return view('anasayfa',['isim'=>'Cihan', 'soyisim'=>'Çakır']);
        return view('anasayfa', compact('isim','soyisim','isimler','kullanicilar'));
       // return view('anasayfa')->with(['isim'=>$isim, 'soyisim'=>$soyisim]);
    }
}
