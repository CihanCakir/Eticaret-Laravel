<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi)
    {
        $kategori = Kategori::where('slug',$slug_kategoriadi)->firstOrFail();
        $alt_kategori = Kategori::where('ust_id',$kategori->id)->get();

 // discint çift olan kayıtları teke düşürülmesini sağlıypr
        $order =request('order');
        if ($order == 'coksatanlar'){
            $urunler = $kategori->urunler()
                ->distinct()
                ->join('urun_tamdetay','urun_tamdetay.urun_id','urun.id')
                ->orderByDesc('urun_tamdetay.goster_cok_satan')
                ->paginate(2);

        }elseif ($order == 'yeni'){

            $urunler= $kategori->urunler()->distinct()->orderByDesc('degistirilime_tarihi')->paginate(2);

        }else {
            $urunler= $kategori->urunler()->paginate(2);

        }

        return view('kategori', compact('kategori', 'alt_kategori', 'urunler','order'));
    }
}
