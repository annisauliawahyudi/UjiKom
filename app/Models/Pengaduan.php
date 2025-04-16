<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe_pengaduan_id',
        'provinsi',
        'kota_kabupaten',
        'kecamatan',
        'kelurahan',
        'keluhan',
        'gambar',
        'view_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function status()
    {
        return $this->belongsTo(StatusPengaduan::class, 'status_pengaduan_id'); 
    }

    public function tipePengaduan()
    {
        return $this->belongsTo(TipePengaduan::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

        public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
