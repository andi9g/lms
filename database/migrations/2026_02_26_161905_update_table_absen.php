<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table("absenpelajaran")->truncate();
        Schema::table('absenpelajaran', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn('idjp');

            // Tambah kolom baru
            $table->integer('masuk')->nullable()->after("materi");
            $table->integer('keluar')->nullable()->after("masuk");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absenpelajaran', function (Blueprint $table) {
            
            // Hapus kolom baru
            $table->dropColumn(['masuk', 'keluar']);

            // Kembalikan kolom lama
            $table->unsignedBigInteger('idjp')->nullable();
        });
    }
};
