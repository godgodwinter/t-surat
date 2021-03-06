<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surat_masuk extends Model
{
        public $table = "surat_masuk";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl_arsip',
            'perihal',
            'kategori_id',
            'lampiran',
            'lampiran',
            'upload_file',
            // 'divisi_id',
            'users_id',
            'status',
        ];

}
