<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('gurumapel');
        Schema::create('gurumapel', function (Blueprint $table) {
            $table->bigIncrements('idgurumapel');
            $table->unsignedBigInteger("iduser");
            $table->unsignedBigInteger("idmapel");
            $table->unsignedBigInteger("idsemester");
            $table->unsignedBigInteger("idkelas");
            $table->unsignedBigInteger("idjurusan");
            $table->timestamps();
        });

        Schema::dropIfExists('absenpelajaran');
        Schema::create('absenpelajaran', function (Blueprint $table) {
            $table->bigIncrements('idabsenpelajaran');
            $table->unsignedBigInteger("iduser");
            $table->unsignedBigInteger("idgurumapel");
            $table->integer("masuk");
            $table->integer("keluar");
            $table->unsignedBigInteger("idruang");
            $table->string("materi");
            $table->date("tanggalabsen");
            $table->time("jamabsen");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
