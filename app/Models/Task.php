<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_task', 'deskripsi', 'prioritas', 'user_id', 'status',
        'tanggal_mulai', 'tanggal_selesai', 'lampiran'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'dikerjakan_oleh');
    }


    public function dikerjakanOleh()
{
    return $this->belongsTo(User::class, 'dikerjakan_oleh');
}
}
