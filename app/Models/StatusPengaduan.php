<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengaduan extends Model
{
    protected $fillable = ['status_pengaduan'];

    // relasi ke pengaduan
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'status_pengaduan_id');
    }
}
