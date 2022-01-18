<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surat_kategori extends Model
{
        public $table = "surat_kategori";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
        ];

}
