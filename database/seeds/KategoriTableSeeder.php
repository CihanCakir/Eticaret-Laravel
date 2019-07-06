<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->truncate();
       $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Tunik','slug'=>'tunik']);
       DB::table('kategori')->insert(['kategori_adi'=>'Pardesü','slug'=>'pardesu','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Ferace','slug'=>'ferace','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Abiye','slug'=>'abiye','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Askılı','slug'=>'askili','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Askısız','slug'=>'askisiz','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Elbise','slug'=>'elbise']);
        DB::table('kategori')->insert(['kategori_adi'=>'Etek','slug'=>'etek']);
        DB::table('kategori')->insert(['kategori_adi'=>'Pantolon','slug'=>'pantolon']);
        DB::table('kategori')->insert(['kategori_adi'=>'Tshirt','slug'=>'tshirt']);
        DB::table('kategori')->insert(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Dergi','slug'=>'dergi']);
        DB::table('kategori')->insert(['kategori_adi'=>'Mobilya','slug'=>'kitap']);
        DB::table('kategori')->insert(['kategori_adi'=>'Kitap','slug'=>'kitap']);
        DB::table('kategori')->insert(['kategori_adi'=>'Tunik','slug'=>'tunik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Katalog','slug'=>'katalog']);
        DB::table('kategori')->insert(['kategori_adi'=>'Boya','slug'=>'boya']);

    }
}
