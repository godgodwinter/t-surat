<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukDistribusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk_distribusi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surat_masuk_id');
            $table->string('divisi_id');
            $table->string('users_id')->nullable(); //jika kosong maka ke smua  users divisi tersebut
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk_distribusi');
    }
}
