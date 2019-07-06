<?php

namespace App\Http\Controllers;

use App\Models\urun;
use App\Models\UrunTamDetay;
use Illuminate\Http\Request;

use App\Models\Kategori;
class AnasayfaController extends Controller
{
    public function index(){

            $kategoriler = Kategori::whereRaw('ust_id is null')->take(8)->get();

            // yeni düzen (start)

        $urun_one_cikar = urun::select('urun.*')
            ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
            ->where('urun_tamdetay.goster_one_cikar',1)
            ->orderBy('degistirilime_tarihi', 'desc')
            ->take(4)->get();
        $urun_cok_satan = urun::select('urun.*')
            ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
            ->where('urun_tamdetay.goster_cok_satan',1)
            ->orderBy('degistirilime_tarihi', 'desc')
            ->take(4)->get();
        $urun_indirimli = urun::select('urun.*')
            ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
            ->where('urun_tamdetay.goster_indirimli',1)
            ->orderBy('degistirilime_tarihi', 'desc')
            ->take(4)->get();
        $urun_gunun_firsati = urun::select('urun.*')
            ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
            ->where('urun_tamdetay.goster_gunun_firsati',1)
            ->orderBy('degistirilime_tarihi', 'desc')
            ->first();


        $urunler_slider = urun::select('urun.*')
            ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
            ->where('urun_tamdetay.goster_slider',1)
            ->orderBy('degistirilime_tarihi', 'desc')
            ->take(5)->get();



        //yeni düzen (son)


      /*   eski şema başlangıç)
         $urunler_slider = UrunTamDetay::with('urun')
                ->where('goster_slider',1)
                ->take(5)
                ->get();
         $urun_one_cikar = UrunTamDetay::with('urun')
            ->where('goster_one_cikar',1)
            ->take(4)
            ->get();
        $urun_cok_satan = UrunTamDetay::with('urun')
            ->where('goster_cok_satan',1)
            ->take(4)
            ->get();
        $urun_indirimli = UrunTamDetay::with('urun')
            ->where('goster_indirimli',1)
            ->take(4)
            ->get();
      eski şema son
      */

        return view('anasayfa', compact('kategoriler','urunler_slider','urun_gunun_firsati','urun_one_cikar','urun_cok_satan','urun_indirimli'));

    }
}
