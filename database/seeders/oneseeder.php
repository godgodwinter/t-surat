<?php

namespace Database\Seeders;

use App\Models\kategori;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class oneseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ADMIN SEEDER
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'tipeuser' => 'admin',
            'nomerinduk' => '1',
            'username' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


          //settings SEEDER
        DB::table('settings')->insert([
            'app_nama' => 'SSB Tulusrejo FC',
            'app_namapendek' => 'SSB',
            'paginationjml' => '10',
            'lembaga_nama' => 'SSB Tulusrejo FC',
            'lembaga_jalan' => 'Jl. Raya Kromengan No. 11, Kec. Kromengan, Kab. Malang',
            'lembaga_telp' => '0341-123456',
            'lembaga_kota' => 'Malang',
            'lembaga_logo' => 'assets/upload/logo.png',
            'sekolahttd' => 'Nama Kepala Sekolah M.Pd',
            'wa_status' => 'Offline',
            'wa_linkoff' => 'http://localhost:8081/',
            'wa_linkon' => 'http://localhost:8081/',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


          $faker = Faker::create('id_ID');

          $nama='Paimin';
          $nomerinduk='123';
          $users_id=DB::table('users')->insertGetId([
              'name' =>  $nama,
              'email' => $faker->unique()->email,
              'username'=>'humas',
              'nomerinduk'=>$nomerinduk,
              'password' => Hash::make('humas'),
              'tipeuser' => 'user',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);


          DB::table('pelatih')->insert([
              'nama' => $nama,
              'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
              'alamat' => $faker->unique()->address,
              'telp' => $faker->unique()->phoneNumber,
              'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
              'spesialis' => $faker->randomElement(['Taktik', 'Teknik','Fisik']),
              'users_id' => $users_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);



          $nama='Paijo';
          $nomerinduk='111';
          $users_id=DB::table('users')->insertGetId([
              'name' =>  $nama,
              'email' => $faker->unique()->email,
              'username'=>'pemain',
              'nomerinduk'=>$nomerinduk,
              'password' => Hash::make('pemain'),
              'tipeuser' => 'pemain',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);


          DB::table('pemain')->insert([
              'nama' => $nama,
              'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
              'alamat' => $faker->unique()->address,
              'telp' => $faker->unique()->phoneNumber,
              'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
              'tgldaftar' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
              'users_id' => $users_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);


    }
}
