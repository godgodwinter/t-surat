<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surat_masuk_distribusi extends Model
{
        public $table = "surat_masuk_distribusi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'surat_masuk_id',
            'divisi_id',
            'users_id',
        ];

}
