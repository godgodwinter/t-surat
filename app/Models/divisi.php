<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class divisi extends Model
{
        public $table = "divisi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
        ];

}
