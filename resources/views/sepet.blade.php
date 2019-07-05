@extends('layouts.master')
@section('title','Sepet Sayfanız')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>İşlem</th>
                </tr>
                <tr>
                    <td colspan="5">Henüz sepette ürün yok</td>
                </tr>
                <tr>
                    <td> <img src="http://lorempixel.com/120/100/food/2"> Ürün adı</td>
                    <td>18.99</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default">-</a>
                        <span style="padding: 10px 20px">1</span>
                        <a href="#" class="btn btn-xs btn-default">+</a>
                    </td>
                    <td>18.99</td>
                    <td>
                        <a href="#">Sil</a>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Toplam Tutar (KDV Dahil)</th>
                    <th>18.99</th>
                    <th></th>
                </tr>
            </table>
            <div>
                <a href="#" class="btn btn-info pull-left">Sepeti Boşalt</a>
                <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
    @endsection