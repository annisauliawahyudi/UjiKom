<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'ip_address',
        'session_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}
