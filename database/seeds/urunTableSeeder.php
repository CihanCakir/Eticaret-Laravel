<?php

use Illuminate\Database\Seeder;
use App\Models\urun;
use App\Models\UrunTamDetay;

class urunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      urun::truncate();
      UrunTamDetay::truncate();
       for($i=0; $i<30; $i++)
       {
           $urun_adi = $faker->sentence(2);
          $urun = urun::create([
               'urun_adi'=>$urun_adi,
               'slug'=> str_slug($urun_adi),
               'urun_fiyati'=>$faker->randomFloat(3,1,20),
               'urun_detay'=>$faker->sentence(20)
           ]);
          $detay = $urun->detay()->create([
             'goster_slider'=>rand(0,1),
              'goster_gunun_firsati'=>rand(0,1),
              'goster_one_cikar'=>rand(0,1),
              'goster_cok_satan'=>rand(0,1),
              'goster_indirimli'=>rand(0,1)

          ]);
       }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
