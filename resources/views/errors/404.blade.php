@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="jumbotron text-center">


        <h1>404 not found </h1>
        <h2>Aradığınız sayfa bulunamadı</h2>
        <a href="{{ route('anasayfa') }}" class="btn btn-primary"> Anasayfa'ya dön</a>
    </div>
    </div>
    @endsection