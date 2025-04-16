<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipePengaduan extends Model
{
    protected $fillable = ['nama'];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
