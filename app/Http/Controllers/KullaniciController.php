<?php

namespace App\Http\Controllers;

use Cart;
use App\Kullanici;
use App\Mail\KullaniciKayitMail;
use App\Models\SepetUrun;
use App\Models\Sepet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KullaniciController extends Controller
{
    public function  __construct()
    {
        $this->middleware('guest')->except('oturumukapat');
    }

    public function giris_form()
    {
        return view('kullanici.oturumac');
    }

    public  function  giris()
    {
        $this->validate(request(),[
           'email' => 'required|email',
           'sifre' =>  'required'
        ]);
        if (auth()->attempt(['email'=>request('email'),'password'=>request('sifre')], request()->has('benihatirla')))
        {
            request()->session()->regenerate();


            $aktif_sepet_id =Sepet::firstOrCreate(['kullanici_id' => auth()->id()])->id;
            session()->put('aktif_sepet_id',$aktif_sepet_id);
            if (Cart::count()>0)
            {
                foreach (Cart::content() as $cartItem)
                {
                    SepetUrun::updateOrCreate(
                    ['sepet_id' => $aktif_sepet_id, 'urun_id' => $cartItem->id],
                      ['adet' => $cartItem->qty, 'fiyati'=> $cartItem->price, 'durum' => 'Beklemede']
                    );
                }
            }
            Cart::destroy();
           // daha hızlı $sepeturunler = SepetUrun::with('urun')->where('sepet_id','aktif_sepet_id')->get();
            $sepeturunler = SepetUrun::where('sepet_id', $aktif_sepet_id)->get();
            foreach ($sepeturunler as $sepeturun)
            {
                Cart::add($sepeturun->urun->id, $sepeturun->urun->urun_adi, $sepeturun->adet, $sepeturun->fiyati,
                ['slug' => $sepeturun->urun->slug]);
            }
            return redirect()->intended('/');
        }else{
            $errors = ['email' => 'Hatalı Giriş'];
            return back()->withErrors($errors);
        }

    }
    public function kaydol_form()
    {
        return view('kullanici.kaydol');
    }

    public  function  kaydol()
    {
        $this->validate(request(),[
            'adsoyad' => 'required|min:6|max:60',
            'email' => 'required|email|unique:kullanici',
            'sifre' => 'required|confirmed|min:5|max:60|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);

        $kullanici = Kullanici::create([
            'adsoyad' => request('adsoyad'),
            'email' => request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon_anahtari' => Str::random(60),
            'aktif_mi' => 0
        ]);
        Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici));

        auth()->login($kullanici);

        return redirect()->route('anasayfa');
    }
    public function  aktiflestir($anahtar)
    {
        $kullanici = Kullanici::where('aktivasyon_anahtari', $anahtar)->first();
        if (!is_null($kullanici)){
            $kullanici->aktivasyon_anahtari = null;
            $kullanici->aktif_mi =1 ;
            $kullanici->save();
            return redirect()->to('/')
                ->with('mesaj','Kullanici kayıdınız aktifleştirildi')
                ->with('mesaj_tur', 'success');
        }
        else{
            return redirect()->to('/')
                ->with('mesaj','kullanici kaydınız aktifleştirilemedi')
                ->with('mesaj_tur','warning');
        }
    }
    public function oturumukapat(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
