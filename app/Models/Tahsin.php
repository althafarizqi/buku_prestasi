<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahsin extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id',
        'tingkat',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan',
    ];
}