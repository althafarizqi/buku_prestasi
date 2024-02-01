<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBulanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'siswa_id',
        'semester',
        'tahun_ajaran',
    ];
}