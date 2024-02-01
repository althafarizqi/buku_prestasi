<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetailKenaikanJuz extends Model
{
    use HasFactory;
     protected $fillable = [
        'id',
        'kenaikan_juz_id',
        'juz',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan'
    ];
}