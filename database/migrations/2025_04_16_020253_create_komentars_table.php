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
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
           // Relasi ke pengaduan
            $table->foreignId('pengaduan_id')->nullable()->constrained()->onDelete('cascade');

            // Relasi ke user (nullable, untuk guest biarkan null)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Nama guest jika bukan user login
            $table->string('guest_name')->nullable();

            // Isi komentar
            $table->text('isi');

            // Tipe komentator: 'user' atau 'guest'
            $table->enum('tipe_komentator', ['user', 'guest']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
