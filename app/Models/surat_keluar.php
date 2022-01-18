<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surat_keluar extends Model
{
        public $table = "surat_keluar";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl',
            'perihal',
            'konten',
            'divisi_id',
            'users_id',
            'status',
            'kategori_id',
        ];

}
