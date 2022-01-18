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
            'app_nama' => 'SI Administrasi Surat',
            'app_namapendek' => 'SAS',
            'paginationjml' => '10',
            'lembaga_nama' => 'PT Administrasi Surat',
            'lembaga_jalan' => 'Jl. Raya Kromengan No. 01, Kec. Kromengan, Kab. Malang',
            'lembaga_telp' => '0341-123456',
            'lembaga_kota' => 'Malang',
            'lembaga_logo' => 'assets/upload/logo.png',
            'sekolahttd' => 'Nama Kepala Sekolah M.Pd',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


          $faker = Faker::create('id_ID');

        DB::table('divisi')->insertGetId([
          'nama' =>  'Inventaris',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);


          $divisi_id=DB::table('divisi')->insertGetId([
              'nama' =>  'Personalia',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);


        DB::table('divisi')->insertGetId([
            'nama' =>  'administrasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('divisi')->insertGetId([
            'nama' =>  'produksi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('divisi')->insertGetId([
            'nama' =>  'pemasaran',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

          $nama='Paimin';
          $nomerinduk='123';
          $users_id=DB::table('users')->insertGetId([
              'name' =>  $nama,
              'email' => $faker->unique()->email,
              'username'=>'humas',
              'nomerinduk'=>$nomerinduk,
              'password' => Hash::make('humas'),
              'tipeuser' => 'divisi',
              'divisi_id' => $divisi_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);


          $users_id=DB::table('users')->insertGetId([
            'name' =>  'Paijo',
            'email' => $faker->unique()->email,
            'username'=>'direksi',
            'nomerinduk'=>'99',
            'password' => Hash::make('direksi'),
            'tipeuser' => 'direksi',
            'divisi_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


          DB::table('kategori')->insertGetId([
            'nama' =>  'Peminjaman',
            'prefix' =>  'suratmasuk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('kategori')->insertGetId([
          'nama' =>  'Lamaran Pekerjaan',
          'prefix' =>  'suratmasuk',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);

      DB::table('kategori')->insertGetId([
        'nama' =>  'Undangan',
        'prefix' =>  'suratmasuk',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);


    DB::table('kategori')->insertGetId([
        'nama' =>  'Pengantar',
        'prefix' =>  'suratkeluar',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
    DB::table('kategori')->insertGetId([
        'nama' =>  'Pengajuan',
        'prefix' =>  'suratkeluar',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);

    DB::table('kategori')->insertGetId([
        'nama' =>  'Permohonan',
        'prefix' =>  'suratkeluar',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
    }
}
