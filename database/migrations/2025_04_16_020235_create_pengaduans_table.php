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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            // relasi ke user dan tipe pengaduan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipe_pengaduan_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_pengaduan_id')->default(1)->constrained()->onDelete('cascade');
            // alamat/lokasi
            $table->string('provinsi'); 
            $table->string('kota_kabupaten'); 
            $table->string('kecamatan'); 
            $table->string('kelurahan'); 

            // deskripsi/keluhan dan file
            $table->text('keluhan');
            $table->string('gambar');
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};