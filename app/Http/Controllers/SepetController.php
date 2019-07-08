<?php

namespace App\Http\Controllers;

use App\Models\SepetUrun;
use App\Models\urun;
use App\Models\Sepet;
use Cart;
use Validator;
use Illuminate\Http\Request;

class SepetController extends Controller
{
/*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    public function index()
    {
        return view('sepet');
    }

    public function ekle()
    {
        $urun = urun::find(request('id'));
       $cartItem = Cart::add($urun->id, $urun->urun_adi,1,$urun->urun_fiyati,['slug'=>$urun->slug]);

        if (auth()->check())
        {
            $aktif_spet_id =session('aktif_sepet_id');
            if (!isset($aktif_spet_id)){
                $aktif_spet = Sepet::create([
                    'kullanici_id' => auth()->id()
                ]);
                $aktif_spet_id =  $aktif_spet->id;
                session()->put('aktif_sepet_id',$aktif_spet_id);
            }
            SepetUrun::updateOrCreate(
              ['sepet_id' => $aktif_spet_id, 'urun_id' => $urun->id],
                ['adet'=>$cartItem->qty, 'fiyati' => $urun->urun_fiyati, 'durum' => 'Beklemede']
            );
             }
        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün Sepete Eklendi.');
    }
    public  function  kaldir($rowid)
    {
        if (auth()->check())
        {
            $aktif_spet_id =session('aktif_sepet_id');
            $cartItem = Cart::get($rowid);
            SepetUrun::where('sepet_id', $aktif_spet_id)->where('urun_id',$cartItem->id)->delete();
        }


        Cart::remove($rowid);
        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','warning')
            ->with('mesaj','Ürün Sepetten Kaldırıldı.');
    }

    public  function  bosalt()
    {
        if (auth()->check())
        {
            $aktif_spet_id =session('aktif_sepet_id');
            SepetUrun::where('sepet_id', $aktif_spet_id)->delete();
        }
        Cart::destroy();
        return redirect()->route('sepet')
            ->with('mesaj_tur','warning')
            ->with('mesaj','Sepetiniz boşaltıldı');
    }

    public function guncelle($rowid){
        $validator = Validator::make(request()->all(),[
            'adet' => 'required|numeric|between:0,10'
        ]);
        if ($validator->fails())
        {
            session()->flash('mesaj_tur','danger');
            session()->flash('mesaj', 'Adet değeri 1-10 arasında olmalıdır.');
            return response()->json(['success'=>false]);

        }

        if (auth()->check())
        {
            $aktif_spet_id =session('aktif_sepet_id');
            $cartItem = Cart::get($rowid);
            if (request('adet')==0)
                SepetUrun::where('sepet_id', $aktif_spet_id)->where('urun_id',$cartItem->id)->delete();
            else
            SepetUrun::where('sepet_id', $aktif_spet_id)->where('urun_id',$cartItem->id)
                ->update(['adet'=> request('adet')]);
        }

        Cart::update($rowid, request('adet'));

        session()->flash('mesaj_tur','success');
        session()->flash('mesaj', 'Adet bilgisi Güncellendi');

        return response()->json(['success' => true]);

    }
}
