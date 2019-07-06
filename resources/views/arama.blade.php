@extends('layouts.master')
@section('title','arama')
@section('content')
 <div class="container">

     <div class="breadcrumb">
            <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>
            <li class="active">listelenen Sonuçlar</li>
     </div>

     <div class="products bg-content">
<div class="row">
    @if(count($urunler)== 0)
            <div class="col-md-12 text-center">
                Bir ürün bulunamadı !
            </div>
        @endif
        @foreach($urunler as $urun)
        <div class="col-md-3 product">
            <a href="{{ route('urun', $urun->slug) }}"><img src="http://via.placeholder.com/300x300?text=UrunResim"></a>
            <p><a href="{{ route('urun', $urun->slug) }}"> {{ $urun->urun_adi }}</a></p>
            <p class="price">{{ $urun->urun_fiyati }} ₺</p>
        </div>
            @endforeach
</div>

         {{ $urunler->appends(['aranan' => old('aranan')])->links() }}
     </div>
 </div>

    @endsection