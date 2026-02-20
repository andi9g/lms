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
        Schema::dropIfExists('detailuser');
        Schema::create('detailuser', function (Blueprint $table) {
            $table->bigIncrements('iddetailuser');
            $table->unsignedBigInteger("iduser");
            $table->unsignedBigInteger("idinstansi")->nullable();
            $table->char("nip", 18);
            $table->string("nama");
            $table->timestamps();
        });
        Schema::dropIfExists('posisi');
        Schema::create('posisi', function (Blueprint $table) {
            $table->bigIncrements('idposisi');
            $table->unsignedBigInteger("iduser");
            $table->enum("posisi", ["admin", "guru", "waka", "kepsek"]);
            $table->timestamps();
        });
        Schema::dropIfExists('fotoprofil');
        Schema::create('fotoprofil', function (Blueprint $table) {
            $table->bigIncrements('idfotoprofil');
            $table->unsignedBigInteger("iduser");
            $table->string("fotoprofil");
            $table->timestamps();
        });
        Schema::dropIfExists('mapel');
        Schema::create('mapel', function (Blueprint $table) {
            $table->bigIncrements('idmapel');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namamapel");
            $table->timestamps();
        });
        Schema::dropIfExists('kelas');
        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('idkelas');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namakelas");
            $table->timestamps();
        });
        Schema::dropIfExists('jurusan');
        Schema::create('jurusan', function (Blueprint $table) {
            $table->bigIncrements('idjurusan');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namajurusan");
            $table->timestamps();
        });
        Schema::dropIfExists('ruang');
        Schema::create('ruang', function (Blueprint $table) {
            $table->bigIncrements('idruang');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namaruang");
            $table->timestamps();
        });
        Schema::dropIfExists('jp');
        Schema::create('jp', function (Blueprint $table) {
            $table->bigIncrements('idjp');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namajp");
            $table->timestamps();
        });
        Schema::dropIfExists('semester');
        Schema::create('semester', function (Blueprint $table) {
            $table->bigIncrements('idsemester');
            $table->unsignedBigInteger("idinstansi");
            $table->string("namasemester");
            $table->char("tahunpelajaran", 10);
            $table->timestamps();
        });
        Schema::dropIfExists('instansi');
        Schema::create('instansi', function (Blueprint $table) {
            $table->bigIncrements('idinstansi');
            $table->char("npsn", 20)->nullable();
            $table->string("namainstansi")->nullable();
            $table->string("alamat")->nullable();
            $table->string("logo")->nullable();
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
