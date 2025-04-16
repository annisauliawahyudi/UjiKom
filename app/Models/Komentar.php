<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = [
        'isi',
        'pengaduan_id',
        'user_id',
        'guest_name',
        'tipe_komentator',
    ];

    // Komentar milik satu pengaduan
    public function pengaduan() {
        return $this->belongsTo(Pengaduan::class);
    }

    // Komentar dari user (jika login)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
